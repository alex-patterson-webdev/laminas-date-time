<?php

declare(strict_types=1);

namespace ArpTest\LaminasDateTime\Factory\Hydrator\Strategy;

use Arp\LaminasDateTime\Factory\Hydrator\Strategy\DateTimeStrategyFactory;
use Arp\LaminasFactory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Laminas\Hydrator\Strategy\DateTimeFormatterStrategy;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerExceptionInterface;

/**
 * @covers  \Arp\LaminasDateTime\Factory\Hydrator\Strategy\DateTimeStrategyFactory
 */
final class DateTimeStrategyFactoryTest extends TestCase
{
    /**
     * @var ContainerInterface&MockObject
     */
    private ContainerInterface $container;

    public function setUp(): void
    {
        $this->container = $this->createMock(ContainerInterface::class);
    }

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
     *
     * @throws ContainerExceptionInterface
     */
    public function testInvokeWillThrowServiceNotCreatedExceptionIfTheFormatOptionIsNotProvided(): void
    {
        $factory = new DateTimeStrategyFactory();

        $requestedName = DateTimeFormatterStrategy::class;

        $this->expectException(ServiceNotCreatedException::class);
        $this->expectExceptionMessage(
            sprintf(
                'The required \'format\' configuration option is missing for service \'%s\'',
                $requestedName
            )
        );

        $factory($this->container, $requestedName, []);
    }

    /**
     * Assert that a ServiceNotCreatedException will be thrown if unable to load a 'format' option from
     * configuration
     *
     * @throws ContainerExceptionInterface
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

        $requestedName = DateTimeFormatterStrategy::class;

        $this->container->expects($this->once())
            ->method('has')
            ->with('config')
            ->willReturn(true);

        $this->container->expects($this->once())
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

        $factory($this->container, $requestedName);
    }

    /**
     * Assert that the __invoke() method will return a configured DateTimeStrategy
     *
     * @param array<mixed>|null $options
     *
     * @dataProvider getInvokeReturnsDateTimeStrategyData
     *
     * @throws ContainerExceptionInterface
     */
    public function testInvokeReturnsDateTimeStrategy(?array $options): void
    {
        $factory = new DateTimeStrategyFactory();

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

            $this->container->expects($this->once())
                ->method('has')
                ->with('config')
                ->willReturn(true);

            $this->container->expects($this->once())
                ->method('get')
                ->with('config')
                ->willReturn($applicationConfig);
        }

        /** @noinspection UnnecessaryAssertionInspection */
        $this->assertInstanceOf(
            DateTimeFormatterStrategy::class,
            $factory($this->container, $requestedName, $options)
        );
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
