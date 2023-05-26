<?php

declare(strict_types=1);

namespace Arp\LaminasDateTime\Factory\Psr;

use Arp\DateTime\DateTimeImmutableFactory;
use Arp\DateTime\Exception\DateTimeFactoryException;
use Arp\DateTime\Psr\FixedClock;
use Arp\LaminasFactory\AbstractFactory;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;

final class FixedClockFactory extends AbstractFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws DateTimeFactoryException
     */
    public function __invoke(ContainerInterface $container, string $requestedName, array $options = null): FixedClock
    {
        $options = $options ?? $this->getServiceOptions($container, $requestedName, 'laminas_date_time');

        if (empty($options['date_time_immutable'])) {
            throw new ServiceNotCreatedException(
                sprintf(
                    'The required \'date_time_immutable\' configuration option is missing for service \'%s\'',
                    $requestedName
                ),
            );
        }

        if (is_string($options['date_time_immutable'])) {
            /** @var DateTimeImmutableFactory $dateTimeImmutableFactory */
            $dateTimeImmutableFactory = $this->getService($container, DateTimeImmutableFactory::class, $requestedName);
            $options['date_time_immutable'] = $dateTimeImmutableFactory->createDateTime(
                $options['date_time_immutable'],
            );
        }

        return new FixedClock($options['date_time_immutable']);
    }
}
