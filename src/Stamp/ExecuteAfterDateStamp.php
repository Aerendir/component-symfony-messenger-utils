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

namespace SerendipityHQ\Component\Messenger\Stamp;

use SerendipityHQ\Component\Messenger\Stamp\Factory\DelayStampFactory;
use Symfony\Component\Messenger\Stamp\DelayStamp;

trigger_deprecation('serendipity_hq/component-symfony-messenger-utils', '2.1.0', 'The "%s" class is deprecated, Use "%s" or "%s" instead.', ExecuteAfterDateStamp::class, DelayStamp::class, DelayStampFactory::class);

/**
 * Creates a DelayStamp starting from a date in the future.
 *
 * @depracated since 2.1.0. Use Symfony\Component\Messenger\Stamp\DelayStamp or SerendipityHQ\Component\Messenger\Stamp\Factory\DelayStampFactory instead.
 */
final class ExecuteAfterDateStamp
{
    /**
     * Disable instantiation.
     */
    private function __construct()
    {
    }

    public static function executeAfter(\DateTimeInterface $executeAfter): DelayStamp
    {
        $now  = (int) (new \DateTimeImmutable())->format('U');
        $diff = \abs((int) $executeAfter->format('U') - $now) * 1_000;

        return new DelayStamp($diff);
    }
}
