<?php

declare(strict_types=1);

namespace ArpTest\LaminasDateTime\Factory\Hydrator\Strategy;

use Arp\DateTime\DateTimeFactory;
use Arp\LaminasDateTime\Factory\Hydrator\Strategy\DateTimeStrategyFactory;
use Arp\LaminasFactory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Laminas\Hydrator\Strategy\DateTimeFormatterStrategy;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers  \Arp\LaminasDateTime\Factory\Hydrator\Strategy\DateTimeStrategyFactory
 *
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package ArpTest\LaminasDateTime\Factory\Hydrator\Strategy
 */
final class DateTimeStrategyFactoryTest extends TestCase
{
    /**
     * Assert the factory class implements FactoryInterface
     */
    public function testImplementsFactoryInterface(): void
    {
        $factory = new DateTimeStrategyFactory();

        $this->assertInstanceOf(FactoryInterface::class, $factory);
    }

    /**
     * Assert that a ServiceNotCreatedException will be thrown if calling __invoke without a format option
     */
    public function testInvokeWillThrowServiceNotCreatedExceptionIfTheFormatOptionIsNotProvided(): void
    {
        $factory = new DateTimeStrategyFactory();

        /** @var ContainerInterface&MockObject $container */
        $container = $this->createMock(ContainerInterface::class);

        $requestedName = DateTimeFormatterStrategy::class;

        $this->expectException(ServiceNotCreatedException::class);
        $this->expectExceptionMessage(
            sprintf(
                'The required \'format\' configuration option is missing for service \'%s\'',
                $requestedName
            )
        );

        $factory($container, $requestedName, []);
    }

    /**
     * Assert that a ServiceNotCreatedException will be thrown if unable to load a 'format' option from
     * configuration
     */
    public function testInvokeWillThrowServiceNotCreatedExceptionIfTheFormatOptionIsNotLoaded(): void
    {
        $factory = new DateTimeStrategyFactory();

        $applicationConfig = [
            'arp' => [
                'services' => [
                    DateTimeFormatterStrategy::class => [
                        // Missing format option
                    ],
                ],
            ],
        ];

        /** @var ContainerInterface&MockObject $container */
        $container = $this->createMock(ContainerInterface::class);

        $requestedName = DateTimeFormatterStrategy::class;

        $container->expects($this->once())
            ->method('has')
            ->with('config')
            ->willReturn(true);

        $container->expects($this->once())
            ->method('get')
            ->with('config')
            ->willReturn($applicationConfig);

        $this->expectException(ServiceNotCreatedException::class);
        $this->expectExceptionMessage(
            sprintf(
                'The required \'format\' configuration option is missing for service \'%s\'',
                $requestedName
            )
        );

        $factory($container, $requestedName);
    }

    /**
     * Assert that the __invoke() method will return a configured DateTimeStrategy
     *
     * @param array<mixed>|null $options
     *
     * @dataProvider getInvokeReturnsDateTimeStrategyData
     */
    public function testInvokeReturnsDateTimeStrategy(?array $options): void
    {
        $factory = new DateTimeStrategyFactory();

        /** @var ContainerInterface&MockObject $container */
        $container = $this->createMock(ContainerInterface::class);

        $requestedName = DateTimeFormatterStrategy::class;

        if (null === $options) {
            $applicationConfig = [
                'arp' => [
                    'services' => [
                        DateTimeFormatterStrategy::class => [
                            'format' => \DateTimeInterface::RFC3339,
                        ],
                    ],
                ],
            ];

            $container->expects($this->once())->method('has')->with('config')->willReturn(true);
            $container->expects($this->once())->method('get')->with('config')->willReturn($applicationConfig);
        }

        /** @noinspection UnnecessaryAssertionInspection */
        $this->assertInstanceOf(DateTimeFormatterStrategy::class, $factory($container, $requestedName, $options));
    }

    /**
     * @return array<mixed>
     */
    public function getInvokeReturnsDateTimeStrategyData(): array
    {
        return [
            [
                null,
            ],
            [
                [
                    'format' => \DateTimeInterface::ATOM,
                ],
            ],
            [
                [
                    'format' => \DateTimeInterface::RFC3339_EXTENDED,
                ],
            ],
        ];
    }
}
