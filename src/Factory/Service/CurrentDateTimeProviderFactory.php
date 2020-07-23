<?php

declare(strict_types=1);

namespace Arp\LaminasDateTime\Factory\Service;

use Arp\DateTime\CurrentDateTimeProvider;
use Arp\DateTime\DateTimeFactory;
use Arp\DateTime\DateTimeProviderInterface;
use Arp\LaminasFactory\AbstractFactory;
use Interop\Container\ContainerInterface;

/**
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package LaminasDateTime\src\Factory\Service
 */
final class CurrentDateTimeProviderFactory extends AbstractFactory
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return DateTimeProviderInterface
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ): DateTimeProviderInterface {
        $options = $options ?? $this->getServiceOptions($container, $requestedName);

        /** @var DateTimeFactory $factory */
        $dateTimeFactory = $this->getService(
            $container,
            $options['factory'] ?? DateTimeFactory::class,
            $requestedName
        );

        return new CurrentDateTimeProvider($dateTimeFactory);
    }
}
