<?php

declare(strict_types=1);

namespace Arp\LaminasDateTime\Factory;

use Arp\DateTime\DateTimeZoneFactory;
use Arp\DateTime\Exception\DateTimeZoneFactoryException;
use Arp\LaminasFactory\AbstractFactory;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;

final class DateTimeZoneFactoryFactory extends AbstractFactory
{
    /**
     * @throws ContainerExceptionInterface
     */
    public function __invoke(
        ContainerInterface $container,
        string $requestedName,
        array $options = null
    ): DateTimeZoneFactory {
        $options = $options ?? $this->getServiceOptions($container, $requestedName, 'laminas_date_time');

        try {
            return new DateTimeZoneFactory(
                $options['class_name'] ?? \DateTimeZone::class,
            );
        } catch (DateTimeZoneFactoryException $e) {
            throw new ServiceNotCreatedException(
                sprintf('Failed to create date time zone factory \'%s\'', $requestedName),
                $e->getCode(),
                $e,
            );
        }
    }
}
