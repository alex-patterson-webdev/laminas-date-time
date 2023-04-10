<?php

declare(strict_types=1);

namespace Arp\LaminasDateTime\View\Helper;

use Laminas\View\Helper\AbstractHelper;

class DateTimeHelper extends AbstractHelper
{
    public function __construct(private readonly string $format)
    {
    }

    /**
     * @param \DateTimeInterface|null $dateTime
     * @param array<string, mixed>    $options
     *
     * @return string
     */
    public function __invoke(?\DateTimeInterface $dateTime, array $options = []): string
    {
        $format = $options['format'] ?? $this->format;

        if (null === $dateTime) {
            return '';
        }

        return $dateTime->format($format);
    }
}
