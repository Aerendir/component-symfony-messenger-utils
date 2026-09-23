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

namespace SerendipityHQ\Component\Messenger\Rescheduler;

use Psr\Log\LoggerInterface;
use SerendipityHQ\Component\Messenger\Finder\DoctrineMessageFinder;
use SerendipityHQ\Component\Messenger\Stamp\Factory\DelayStampFactory;
use Symfony\Component\Messenger\MessageBusInterface;

final class Rescheduler
{
    private LoggerInterface $logger;
    private MessageBusInterface $commandBus;
    private DoctrineMessageFinder $doctrineMessageFinder;

    public function __construct(
        LoggerInterface $logger,
        MessageBusInterface $commandBus,
        DoctrineMessageFinder $doctrineMessageFinder,
    ) {
        $this->logger                = $logger;
        $this->commandBus            = $commandBus;
        $this->doctrineMessageFinder = $doctrineMessageFinder;
    }

    public function reschedule(object $message, int $delayUnits, string $delayPeriod, bool $ensureUniqueness = true): void
    {
        $this->logger->info('Reschedule set in {delay_units} {delay_period}}', ['delay_units' => $delayUnits, 'delay_period' => $delayPeriod]);

        $logMessage = 'NOT rescheduled as the message already exists';
        if ($ensureUniqueness && false === $this->doctrineMessageFinder->exists($message)) {
            $this->commandBus->dispatch($message, [DelayStampFactory::delayFor($delayUnits, $delayPeriod)]);
            $logMessage = "Rescheduled as the message doesn't already exist";
        }

        $this->logger->debug($logMessage);
    }
}
