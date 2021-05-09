<?php

declare(strict_types=1);

namespace Arp\LaminasDateTime\Factory;

use Arp\DateTime\DateTimeFactory;
use Arp\DateTime\Exception\DateTimeFactoryException;
use Arp\LaminasFactory\AbstractFactory;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Psr\Container\ContainerInterface;

/**
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\LaminasDateTime\Factory
 */
final class DateTimeFactoryFactory extends AbstractFactory
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array<mixed>|null  $options
     *
     * @return DateTimeFactory
     *
     * @throws ServiceNotCreatedException
     */
    public function __invoke(
        ContainerInterface $container,
        string $requestedName,
        array $options = null
    ): DateTimeFactory {
        $options = $options ?? $this->getServiceOptions($container, $requestedName);

        try {
            return new DateTimeFactory(
                $options['date_time_class_name'] ?? null,
                $options['date_time_zone_class_name']
            );
        } catch (DateTimeFactoryException $e) {
            throw new ServiceNotCreatedException(
                sprintf('Failed to create date time factory: %s', $e->getMessage()),
                $e->getCode(),
                $e
            );
        }
    }
}
