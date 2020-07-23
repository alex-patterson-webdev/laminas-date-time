<?php

declare(strict_types=1);

namespace Arp\LaminasDateTime\View\Helper;

use Laminas\View\Helper\AbstractHelper;

/**
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\LaminasDateTime\View\Helper
 */
class DateTimeHelper extends AbstractHelper
{
    /**
     * @var string
     */
    private string $format;

    /**
     * @param string $format
     */
    public function __construct(string $format)
    {
        $this->format = $format;
    }

    /**
     * @param \DateTimeInterface|null $dateTime
     * @param array          $options
     *
     * @return string
     */
    public function __invoke(?\DateTimeInterface $dateTime, array $options = [])
    {
        $format = $options['format'] ?? $this->format;

        if (null === $dateTime) {
            return '';
        }
        return $dateTime->format($format);
    }
}
