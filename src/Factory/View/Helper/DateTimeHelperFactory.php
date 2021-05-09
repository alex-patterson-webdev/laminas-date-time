<?php

declare(strict_types=1);

namespace Arp\LaminasDateTime\Factory\View\Helper;

use Arp\LaminasDateTime\View\Helper\DateTimeHelper;
use Arp\LaminasFactory\AbstractFactory;
use Psr\Container\ContainerInterface;

/**
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\LaminasDateTime\Factory\View\Helper
 */
final class DateTimeHelperFactory extends AbstractFactory
{
    /**
     * @param ContainerInterface        $container
     * @param string                    $requestedName
     * @param array<string, mixed>|null $options
     *
     * @return DateTimeHelper
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
