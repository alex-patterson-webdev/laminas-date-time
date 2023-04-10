<?php

declare(strict_types=1);

namespace ArpTest\LaminasDateTime\Factory;

use Arp\DateTime\DateIntervalFactory;
use Arp\LaminasDateTime\Factory\DateIntervalFactoryFactory;
use Arp\LaminasFactory\FactoryInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

/**
 * @covers \Arp\LaminasDateTime\Factory\DateIntervalFactoryFactory
 */
final class DateIntervalFactoryFactoryTest extends TestCase
{
    /**
     * Assert the factory implements FactoryInterface
     */
    public function testImplementsFactoryInterface(): void
    {
        $factory = new DateIntervalFactoryFactory();

        $this->assertInstanceOf(FactoryInterface::class, $factory);
    }

    /**
     * Assert that the factory will return a valid DateIntervalFactory instance
     */
    public function testInvokeWillReturnAValidDateIntervalFactoryInstance(): void
    {
        $factory = new DateIntervalFactoryFactory();

        /** @var ContainerInterface&MockObject $container */
        $container = $this->createMock(ContainerInterface::class);

        /** @noinspection UnnecessaryAssertionInspection */
        $this->assertInstanceOf(DateIntervalFactory::class, $factory($container, DateIntervalFactory::class));
    }
}
