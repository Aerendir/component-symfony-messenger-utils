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

namespace SerendipityHQ\Component\Messenger\Stamp\Factory;

use Symfony\Component\Messenger\Stamp\DelayStamp;

/**
 * Creates a DelayStamp starting from a date in the future.
 */
final class DelayStampFactory
{
    public const PERIOD_SECONDS = 'seconds';
    public const PERIOD_MINUTES = 'minutes';
    public const PERIOD_HOURS   = 'hours';
    public const PERIOD_DAYS    = 'days';
    public const PERIOD_WEEKS   = 'weeks';
    public const PERIOD_MONTHS  = 'months';
    public const PERIOD_YEARS   = 'years';

    /**
     * Disable instantiation.
     */
    private function __construct()
    {
    }

    public static function delayUntil(\DateTimeInterface $executeAfter): DelayStamp
    {
        $now  = (int) (new \DateTimeImmutable())->setTimezone($executeAfter->getTimezone())->format('U');
        $diff = \abs((int) $executeAfter->format('U') - $now) * 1_000;

        return new DelayStamp($diff);
    }

    /**
     * @param string $period A string representing a unit symbol valid for relative formats of DateTime objects
     *
     * @see https://www.php.net/manual/en/datetime.formats.relative.php#datetime.formats.relative
     */
    public static function delayFor(int $units, string $period): DelayStamp
    {
        $allowedPeriods = [self::PERIOD_SECONDS, self::PERIOD_MINUTES, self::PERIOD_HOURS, self::PERIOD_DAYS, self::PERIOD_WEEKS, self::PERIOD_MONTHS, self::PERIOD_YEARS];
        if (false === \in_array($period, $allowedPeriods, true)) {
            throw new \InvalidArgumentException(sprintf('The passed period "%s" is not allowed. Allowed periods are: %s', $period, \implode(', ', $allowedPeriods)));
        }

        $rescheduleIn = sprintf('+%s %s', $units, $period);
        $executeAfter = (new \DateTime())->modify($rescheduleIn);

        return self::delayUntil($executeAfter);
    }
}
