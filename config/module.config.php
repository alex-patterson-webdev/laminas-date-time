<?php

declare(strict_types=1);

namespace Arp\LaminasDateTime;

use Arp\DateTime\CurrentDateTimeProvider;
use Arp\DateTime\DateTimeFactory;
use Arp\DateTime\Factory\CurrentDateTimeProviderFactory;
use Arp\LaminasDateTime\Factory\View\Helper\DateTimeHelperFactory;
use Arp\LaminasDateTime\View\Helper\DateTimeHelper;
use Laminas\ServiceManager\Factory\InvokableFactory;

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
            DateTimeFactory::class => InvokableFactory::class,
            CurrentDateTimeProvider::class => CurrentDateTimeProviderFactory::class,
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
