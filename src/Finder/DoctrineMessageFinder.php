<?php

declare(strict_types=1);

/*
 * This file is part of the Serendipity HQ Symfony Messenger Utils Component.
 *
 * Copyright (c) Adamo Aerendir Crespi <aerendir@serendipityhq.com>.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SerendipityHQ\Component\Messenger\Finder;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception\TableNotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\PropertyInfo\PropertyInfoExtractorInterface;

final class DoctrineMessageFinder
{
    private Connection $connection;
    private PropertyAccessorInterface $propertyAccessor;
    private PropertyInfoExtractorInterface $propertyInfoExtractor;

    public function __construct(EntityManagerInterface $entityManager, PropertyAccessorInterface $propertyAccessor, PropertyInfoExtractorInterface $propertyInfoExtractor)
    {
        $this->connection            = $entityManager->getConnection();
        $this->propertyAccessor      = $propertyAccessor;
        $this->propertyInfoExtractor = $propertyInfoExtractor;
    }

    public function exists(object $message, bool $onlyNotAlreadyDelivered = true): bool
    {
        $result = $this->find($message, $onlyNotAlreadyDelivered);

        return [] !== $result;
    }

    /**
     * @return array<array-key,mixed>
     */
    public function find(object $message, bool $onlyNotAlreadyDelivered = true): array
    {
        $query        = 'SELECT * FROM public.messenger_messages';
        $whereClauses = [];

        if ($onlyNotAlreadyDelivered) {
            $whereClauses[] = 'delivered_at IS NULL';
        }

        $whereTypeParts   = [];
        $whereTypeParts[] = sprintf("headers::json->>'type' = '%s'", \get_class($message));

        $whereBodyParts = $this->buildWhereBodyParts($message);

        $whereClauses = \array_merge($whereClauses, $whereTypeParts, $whereBodyParts);

        if (\count($whereClauses) > 1) {
            $query .= ' WHERE ';
            $query .= \implode(' AND ', $whereClauses);
        }

        try {
            $stmt   = $this->connection->prepare($query);
            $query  = $stmt->executeQuery();
            $result = $query->fetchAllAssociative();
        }
        // If no message has yet been dispatched, then the table "messenger_messages" doesn't exist
        catch (TableNotFoundException $tableNotFoundException) {
            return [];
        }

        if (false === \is_array($result)) {
            throw new \RuntimeException('The result is not an array but should.');
        }

        return $result;
    }

    /**
     * @return array<array-key,string>
     */
    private function buildWhereBodyParts(object $message): array
    {
        $properties = $this->propertyInfoExtractor->getProperties(\get_class($message)) ?? [];

        $bodyQuery = [];
        foreach ($properties as $propertyName) {
            $value = $this->propertyAccessor->getValue($message, $propertyName);
            if (\is_bool($value)) {
                $value       = true === $value ? 'true' : 'false';
                $bodyQuery[] = sprintf("(body::json->>'%s')::boolean = %s", $propertyName, $value);

                continue;
            }

            $bodyQuery[] = sprintf("body::json->>'%s' = '%s'", $propertyName, $value);
        }

        return $bodyQuery;
    }
}
