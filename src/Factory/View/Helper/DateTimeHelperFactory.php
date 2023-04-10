<?php

declare(strict_types=1);

namespace Arp\LaminasDateTime\Factory\View\Helper;

use Arp\LaminasDateTime\View\Helper\DateTimeHelper;
use Arp\LaminasFactory\AbstractFactory;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;

final class DateTimeHelperFactory extends AbstractFactory
{
    /**
     * @throws ContainerExceptionInterface
     */
    public function __invoke(
        ContainerInterface $container,
        string $requestedName,
        array $options = null
    ): DateTimeHelper {
        $options = $options ?? $this->getServiceOptions($container, $requestedName, 'view_helpers');

        return new DateTimeHelper(
            $options['format'] ?? \DateTimeInterface::ATOM
        );
    }
}
