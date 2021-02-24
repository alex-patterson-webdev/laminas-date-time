<?php

declare(strict_types=1);

namespace Arp\LaminasDateTime;

use Arp\DateTime\DateIntervalFactory;
use Arp\DateTime\DateTimeFactory;
use Arp\LaminasDateTime\Factory\DateIntervalFactoryFactory;
use Arp\LaminasDateTime\Factory\DateTimeFactoryFactory;
use Arp\LaminasDateTime\Factory\Hydrator\Strategy\DateTimeStrategyFactory;
use Arp\LaminasDateTime\Factory\View\Helper\DateTimeHelperFactory;
use Arp\LaminasDateTime\View\Helper\DateTimeHelper;
use Laminas\Hydrator\Strategy\DateTimeFormatterStrategy;

return [
    'arp' => [
        'services' => [
            DateTimeFormatterStrategy::class => [
                'format' => \DateTime::RFC3339,
            ],
            'DayMonthYearFormattingStrategy' => [
                'format' => 'd/m/Y',
            ],
            'YearMonthDayFormattingStrategy' => [
                'format' => 'Y/m/d',
            ],
        ],
        'view_helpers' => [
            DateTimeHelper::class => [
                'format' => 'd/m/Y H:i:s',
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            DateTimeFactory::class => DateTimeFactoryFactory::class,
            DateIntervalFactory::class => DateIntervalFactoryFactory::class,

            // Hydrator strategies
            DateTimeFormatterStrategy::class => DateTimeStrategyFactory::class,
            'DayMonthYearFormattingStrategy' => DateTimeStrategyFactory::class,
            'YearMonthDayFormattingStrategy' => DateTimeStrategyFactory::class,
        ],
    ],
    'view_helpers' => [
        'aliases' => [
            'dateTime' => DateTimeHelper::class,
        ],
        'factories' => [
            DateTimeHelper::class => DateTimeHelperFactory::class,
        ],
    ]
];
