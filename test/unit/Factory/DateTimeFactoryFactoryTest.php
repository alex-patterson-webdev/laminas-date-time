<?php

declare(strict_types=1);

namespace ArpTest\LaminasDateTime\Factory;

use Arp\DateTime\DateTimeFactory;
use Arp\LaminasDateTime\Factory\DateTimeFactoryFactory;
use Arp\LaminasFactory\FactoryInterface;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;

/**
 * @covers \Arp\LaminasDateTime\Factory\DateTimeFactoryFactory
 */
final class DateTimeFactoryFactoryTest extends TestCase
{
    /**
     * Assert the factory implements FactoryInterface
     */
    public function testImplementsFactoryInterface(): void
    {
        $factory = new DateTimeFactoryFactory();

        $this->assertInstanceOf(FactoryInterface::class, $factory);
    }

    /**
     * Assert that the factory will return a valid DateIntervalFactory instance
     *
     * @throws ContainerExceptionInterface
     */
    public function testInvokeWillReturnAValidDateIntervalFactoryInstance(): void
    {
        $factory = new DateTimeFactoryFactory();

        /** @var ContainerInterface&MockObject $container */
        $container = $this->createMock(ContainerInterface::class);

        /** @noinspection UnnecessaryAssertionInspection */
        $this->assertInstanceOf(DateTimeFactory::class, $factory($container, DateTimeFactory::class, []));
    }

    /**
     * Assert that the __invoke() method will throw a ServiceNotCreatedException if the DateTimeFactory cannot be
     * created with the provided date time class name string
     *
     * @throws ContainerExceptionInterface
     */
    public function testInvokeWillThrowAServiceNotCreatedExceptionIfTheDateTimeClassIsInvalid(): void
    {
        $factory = new DateTimeFactoryFactory();

        /** @var ContainerInterface&MockObject $container */
        $container = $this->createMock(ContainerInterface::class);

        $options = [
            'class_name' => \stdClass::class,
        ];

        $requestedName = DateTimeFactory::class;

        $this->expectException(ServiceNotCreatedException::class);
        $this->expectExceptionMessage(sprintf('Failed to create date time factory \'%s\'', $requestedName));

        $factory($container, $requestedName, $options);
    }
}
