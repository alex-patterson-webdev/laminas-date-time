<?php

declare(strict_types=1);

namespace Arp\LaminasDateTime\Factory\View\Helper;

use Arp\LaminasDateTime\View\Helper\DateTimeHelper;
use Arp\LaminasFactory\AbstractFactory;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Laminas\ServiceManager\Exception\ServiceNotFoundException;
use Psr\Container\ContainerInterface;

/**
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\LaminasDateTime\Factory\View\Helper
 */
final class DateTimeHelperFactory extends AbstractFactory
{
    /**
     * @noinspection PhpMissingParamTypeInspection
     *
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return DateTimeHelper
     *
     * @throws ServiceNotCreatedException
     * @throws ServiceNotFoundException
     */
    public function __invoke(ContainerInterface $container, string $requestedName, array $options = null): DateTimeHelper
    {
        $options = $options ?? $this->getServiceOptions($container, $requestedName, 'view_helpers');

        $format = $options['format'] ?? \DateTime::ATOM;

        return new DateTimeHelper($format);
    }
}
