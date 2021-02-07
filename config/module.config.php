<?php

declare(strict_types=1);

namespace Arp\LaminasDateTime;

use Arp\DateTime\DateIntervalFactory;
use Arp\DateTime\DateTimeFactory;
use Arp\LaminasDateTime\Factory\DateIntervalFactoryFactory;
use Arp\LaminasDateTime\Factory\DateTimeFactoryFactory;
use Arp\LaminasDateTime\Factory\View\Helper\DateTimeHelperFactory;
use Arp\LaminasDateTime\View\Helper\DateTimeHelper;

return [
    'arp' => [
        'view_helpers' => [
            DateTimeHelper::class => [
                'format' => 'd/m/Y H:i:s',
            ],
        ]
    ],
    'service_manager' => [
        'factories' => [
            DateTimeFactory::class => DateTimeFactoryFactory::class,
            DateIntervalFactory::class => DateIntervalFactoryFactory::class,
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
