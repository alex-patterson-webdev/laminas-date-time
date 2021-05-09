<?php

declare(strict_types=1);

namespace ArpTest\LaminasDateTime\View\Helper;

use Arp\LaminasDateTime\View\Helper\DateTimeHelper;
use Laminas\View\Helper\HelperInterface;
use PHPUnit\Framework\TestCase;

/**
 * @covers  \Arp\LaminasDateTime\View\Helper\DateTimeHelper
 *
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package ArpTest\LaminasDateTime\View\Helper
 */
final class DateTimeHelperTest extends TestCase
{
    /**
     * Assert that the view helper implements HelperInterface.
     */
    public function testImplementsHelperInterface(): void
    {
        $helper = new DateTimeHelper(\DateTimeInterface::ATOM);

        $this->assertInstanceOf(HelperInterface::class, $helper);
    }

    /**
     * Assert that when we pass NULL to DateTimeHelper::__invoke() that an empty string will be returned
     */
    public function testInvokeWillReturnEmptyStringForNullDateTime(): void
    {
        $helper = new DateTimeHelper(\DateTimeInterface::ATOM);

        $this->assertSame('', $helper(null));
    }

    /**
     * Assert that when calling __invoke() without a format option, the returned date time string will be formatted
     * to the value provided when creating the class
     *
     * @param string $format
     *
     * @dataProvider getInvokeWillFormatDateTimeAccordingToConstructorArgumentFormatData
     */
    public function testInvokeWillFormatDateTimeAccordingToConstructorArgumentFormat(string $format): void
    {
        $helper = new DateTimeHelper($format);

        $dateTime = new \DateTime();

        $this->assertSame($dateTime->format($format), $helper($dateTime));
    }

    /**
     * @return array<mixed>
     */
    public function getInvokeWillFormatDateTimeAccordingToConstructorArgumentFormatData(): array
    {
        return [
            [\DateTimeInterface::ATOM],
            [\DateTimeInterface::RFC822],
            ['Y-m-d H:i:s'],
        ];
    }

    /**
     * Assert that when calling __invoke() without a format option, the returned date time string will be formatted
     * to the value provided when creating the class.
     *
     * @param string $format
     *
     * @dataProvider getInvokeWillFormatDateTimeAccordingToOptionArgumentData
     */
    public function testInvokeWillFormatDateTimeAccordingToOptionArgument(string $format): void
    {
        $helper = new DateTimeHelper(\DateTimeInterface::ATOM);

        $dateTime = new \DateTime();
        $options = [
            'format' => $format,
        ];

        $this->assertSame($dateTime->format($format), $helper($dateTime, $options));
    }

    /**
     * @return array<mixed>
     */
    public function getInvokeWillFormatDateTimeAccordingToOptionArgumentData(): array
    {
        return [
            [\DateTimeInterface::ATOM],
            [\DateTimeInterface::RFC822],
            ['Y-m-d H:i:s'],
        ];
    }
}
