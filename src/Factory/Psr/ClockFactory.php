<?php

declare(strict_types=1);

namespace Arp\LaminasDateTime\Factory\Psr;

use Arp\DateTime\Psr\Clock;
use Arp\LaminasFactory\AbstractFactory;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;

final class ClockFactory extends AbstractFactory
{
    /**
     * @throws ContainerExceptionInterface
     */
    public function __invoke(ContainerInterface $container, string $requestedName, array $options = null): Clock
    {
        $options = $options ?? $this->getServiceOptions($container, $requestedName, 'laminas_date_time');

        if (empty($options['factory'])) {
            throw new ServiceNotCreatedException(
                sprintf(
                    'The required \'factory\' configuration option is missing for service \'%s\'',
                    $requestedName
                ),
            );
        }

        return new Clock(
            $this->getService($container, $options['factory'], $requestedName),
            $options['date_time_zone'] ?? null
        );
    }
}
