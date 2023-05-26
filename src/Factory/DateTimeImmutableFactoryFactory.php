<?php

declare(strict_types=1);

namespace Arp\LaminasDateTime\Factory;

use Arp\DateTime\DateTimeImmutableFactory;
use Arp\DateTime\Exception\DateTimeFactoryException;
use Arp\LaminasFactory\AbstractFactory;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;

final class DateTimeImmutableFactoryFactory extends AbstractFactory
{
    /**
     * @throws ContainerExceptionInterface
     */
    public function __invoke(
        ContainerInterface $container,
        string $requestedName,
        array $options = null
    ): DateTimeImmutableFactory {
        $options = $options ?? $this->getServiceOptions($container, $requestedName, 'laminas_date_time');

        if (isset($options['date_time_zone_factory']) && is_string($options['date_time_zone_factory'])) {
            $options['date_time_zone_factory'] = $this->getService(
                $container,
                $options['date_time_zone_factory'],
                $requestedName
            );
        }

        try {
            return new DateTimeImmutableFactory(
                $options['class_name'] ?? null,
                $options['date_time_zone_factory'] ?? null,
            );
        } catch (DateTimeFactoryException $e) {
            throw new ServiceNotCreatedException(
                sprintf('Failed to create date time immutable factory service \'%s\'', $requestedName),
                $e->getCode(),
                $e,
            );
        }
    }
}
