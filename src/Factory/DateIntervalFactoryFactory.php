<?php

declare(strict_types=1);

namespace Arp\LaminasDateTime\Factory;

use Arp\DateTime\DateIntervalFactory;
use Arp\LaminasFactory\AbstractFactory;
use Psr\Container\ContainerInterface;

final class DateIntervalFactoryFactory extends AbstractFactory
{
    public function __invoke(
        ContainerInterface $container,
        string $requestedName,
        array $options = null
    ): DateIntervalFactory {
        return new DateIntervalFactory();
    }
}
