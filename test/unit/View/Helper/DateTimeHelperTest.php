<?php

declare(strict_types=1);

namespace ArpTest\LaminasDateTime\View\Helper;

use Arp\LaminasDateTime\View\Helper\DateTimeHelper;
use Laminas\View\Helper\HelperInterface;
use PHPUnit\Framework\TestCase;

/**
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package ArpTest\LaminasDateTime\View\Helper
 */
final class DateTimeHelperTest extends TestCase
{
    /**
     * Assert that the view helper implements HelperInterface.
     *
     * @covers \Arp\LaminasDateTime\View\Helper\DateTimeHelper::__construct
     */
    public function testImplementsHelperInterface(): void
    {
        $helper = new DateTimeHelper(\DateTimeInterface::ATOM);

        $this->assertInstanceOf(HelperInterface::class, $helper);
    }

    /**
     * Assert that when we pass NULL to DateTimeHelper::__invoke() that an empty string will be returned.
     *
     * @covers \Arp\LaminasDateTime\View\Helper\DateTimeHelper::__invoke
     */
    public function testInvokeWillReturnEmptyStringForNullDateTime(): void
    {
        $helper = new DateTimeHelper(\DateTimeInterface::ATOM);

        $this->assertSame('', $helper(null));
    }

    /**
     * Assert that when calling __invoke() without a format option, the returned date time string will be formatted
     * to the value provided when creating the class.
     *
     * @param string $format
     *
     * @dataProvider getInvokeWillFormatDateTimeAccordingToConstructorArgumentFormatData
     *
     * @covers \Arp\LaminasDateTime\View\Helper\DateTimeHelper::__invoke
     */
    public function testInvokeWillFormatDateTimeAccordingToConstructorArgumentFormat(string $format): void
    {
        $helper = new DateTimeHelper($format);

        $dateTime = new \DateTime();

        if (null === $format) {
            $format = \DateTimeInterface::ATOM;
        }

        $this->assertSame($dateTime->format($format), $helper($dateTime));
    }

    /**
     * @return array
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
     *
     * @covers \Arp\LaminasDateTime\View\Helper\DateTimeHelper::__invoke
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
     * @return array
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
