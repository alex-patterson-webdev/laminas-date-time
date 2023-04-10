<?php

declare(strict_types=1);

namespace Arp\LaminasDateTime\Factory;

use Arp\DateTime\DateTimeFactory;
use Arp\DateTime\Exception\DateTimeFactoryException;
use Arp\LaminasFactory\AbstractFactory;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;

final class DateTimeFactoryFactory extends AbstractFactory
{
    /**
     * @throws ServiceNotCreatedException
     * @throws ContainerExceptionInterface
     */
    public function __invoke(
        ContainerInterface $container,
        string $requestedName,
        array $options = null
    ): DateTimeFactory {
        $options = $options ?? $this->getServiceOptions($container, $requestedName);

        try {
            return new DateTimeFactory(
                $options['date_time_zone_factory'] ?? null,
                $options['date_time_class_name'] ?? null
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
