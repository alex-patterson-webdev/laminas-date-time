<?php

declare(strict_types=1);

namespace Arp\LaminasDateTime\Factory\Hydrator\Strategy;

use Arp\LaminasFactory\AbstractFactory;
use Interop\Container\ContainerInterface;
use Laminas\Hydrator\Strategy\DateTimeFormatterStrategy;
use Laminas\Hydrator\Strategy\Exception\InvalidArgumentException;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;

/**
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\LaminasDateTime\Factory\Hydrator\Strategy
 */
final class DateTimeStrategyFactory extends AbstractFactory
{
    /**
     * @noinspection PhpMissingParamTypeInspection
     *
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return DateTimeFormatterStrategy
     *
     * @throws ServiceNotCreatedException
     * @throws InvalidArgumentException
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
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
