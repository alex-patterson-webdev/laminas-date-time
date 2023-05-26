<?php

declare(strict_types=1);

namespace Arp\LaminasDateTime;

use Arp\DateTime\DateIntervalFactory;
use Arp\DateTime\DateTimeFactory;
use Arp\DateTime\DateTimeImmutableFactory;
use Arp\DateTime\DateTimeZoneFactory;
use Arp\DateTime\Psr\Clock;
use Arp\DateTime\Psr\SystemClock;
use Arp\LaminasDateTime\Factory\DateIntervalFactoryFactory;
use Arp\LaminasDateTime\Factory\DateTimeFactoryFactory;
use Arp\LaminasDateTime\Factory\DateTimeImmutableFactoryFactory;
use Arp\LaminasDateTime\Factory\DateTimeZoneFactoryFactory;
use Arp\LaminasDateTime\Factory\Psr\ClockFactory;
use Arp\LaminasDateTime\Factory\Psr\SystemClockFactory;
use Arp\LaminasDateTime\Factory\View\Helper\DateTimeHelperFactory;
use Arp\LaminasDateTime\View\Helper\DateTimeHelper;
use Psr\Clock\ClockInterface;

return [
    'arp' => [
        'laminas_date_time' => [
            Clock::class => [
                'factory' => DateTimeImmutableFactory::class,
            ],
            SystemClock::class => [
                'factory' => DateTimeImmutableFactory::class,
            ],
        ],
    ],
    'service_manager' => [
        'aliases' => [
            ClockInterface::class => SystemClock::class,
        ],
        'factories' => [
            Clock::class => ClockFactory::class,
            SystemClock::class => SystemClockFactory::class,

            DateTimeFactory::class => DateTimeFactoryFactory::class,
            DateIntervalFactory::class => DateIntervalFactoryFactory::class,
            DateTimeImmutableFactory::class => DateTimeImmutableFactoryFactory::class,
            DateTimeZoneFactory::class => DateTimeZoneFactoryFactory::class,
        ],
    ],
    'view_helpers' => [
        'aliases' => [
            'dateTime' => DateTimeHelper::class,
        ],
        'factories' => [
            DateTimeHelper::class => DateTimeHelperFactory::class,
        ],
    ],
];
