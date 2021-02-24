<?php

declare(strict_types=1);

namespace Arp\LaminasDateTime\Factory;

use Arp\DateTime\DateTimeFactory;
use Arp\DateTime\Factory\DateTimeFactoryFactory as ArpDateTimeFactoryFactory;
use Arp\Factory\Exception\FactoryException;
use Arp\LaminasFactory\AbstractFactory;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;

/**
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\LaminasDateTime\Factory
 */
final class DateTimeFactoryFactory extends AbstractFactory
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return DateTimeFactory
     *
     * @noinspection PhpMissingParamTypeInspection
     *
     * @throws ServiceNotCreatedException
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): DateTimeFactory
    {
        $options = $options ?? $this->getServiceOptions($container, $requestedName);

        $config = [
            'date_class_name' => $options['date_class_name'] ?? null,
            'time_zone_class_name' => $options['time_zone_class_name'] ?? null,
        ];

        try {
            return (new ArpDateTimeFactoryFactory())->create($config);
        } catch (FactoryException $e) {
            throw new ServiceNotCreatedException(
                sprintf('Failed to create DateTimeFactory service \'%s\': %s', $requestedName, $e->getMessage()),
                $e->getCode(),
                $e
            );
        }
    }
}
