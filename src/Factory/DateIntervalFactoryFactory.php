<?php

declare(strict_types=1);

namespace Arp\LaminasDateTime\Factory;

use Arp\DateTime\DateIntervalFactory;
use Arp\DateTime\Factory\DateIntervalFactoryFactory as ArpDateIntervalFactoryFactory;
use Arp\LaminasFactory\AbstractFactory;
use Psr\Container\ContainerInterface;

/**
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\LaminasDateTime\Factory
 */
final class DateIntervalFactoryFactory extends AbstractFactory
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return DateIntervalFactory
     *
     * @noinspection PhpMissingParamTypeInspection
     */
    public function __invoke(ContainerInterface $container, string $requestedName, array $options = null): DateIntervalFactory
    {
        return (new ArpDateIntervalFactoryFactory())->create();
    }
}
