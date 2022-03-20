<?php

declare(strict_types=1);

namespace Arp\LaminasDateTime\Factory\Hydrator\Strategy;

use Arp\LaminasFactory\AbstractFactory;
use Laminas\Hydrator\Strategy\DateTimeFormatterStrategy;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Laminas\ServiceManager\Exception\ServiceNotFoundException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;

/**
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\LaminasDateTime\Factory\Hydrator\Strategy
 */
final class DateTimeStrategyFactory extends AbstractFactory
{
    /**
     * @param ContainerInterface        $container
     * @param string                    $requestedName
     * @param array<string, mixed>|null $options
     *
     * @return DateTimeFormatterStrategy
     *
     * @throws ServiceNotCreatedException
     * @throws ServiceNotFoundException
     * @throws ContainerExceptionInterface
     */
    public function __invoke(
        ContainerInterface $container,
        string $requestedName,
        array $options = null
    ): DateTimeFormatterStrategy {
        $options = $options ?? $this->getServiceOptions($container, $requestedName);

        $format = $options['format'] ?? null;
        if (null === $format) {
            throw new ServiceNotCreatedException(
                sprintf(
                    'The required \'format\' configuration option is missing for service \'%s\'',
                    $requestedName
                )
            );
        }

        return new DateTimeFormatterStrategy($format, $options['timezone'] ?? null, $options['fallback'] ?? false);
    }
}
