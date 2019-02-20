<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace IxocreateTest\Event;

use Ixocreate\Contract\Application\ConfiguratorRegistryInterface;
use Ixocreate\Contract\Application\ServiceRegistryInterface;
use Ixocreate\Contract\ServiceManager\ServiceManagerInterface;
use Ixocreate\Event\BootstrapItem\SubscriberBootstrapItem;
use Ixocreate\Event\Package;
use PHPUnit\Framework\TestCase;

class PackageTest extends TestCase
{
    /**
     * @var Package
     */
    private $package;

    public function setUp()
    {
        $this->package = new Package();
    }

    /**
     * @covers \Ixocreate\Event\Package
     */
    public function testPackage()
    {
        $configuratorRegistry = $this->getMockBuilder(ConfiguratorRegistryInterface::class)->getMock();
        $configuratorRegistry->method('get')->willThrowException(new \InvalidArgumentException('make tests!'));
        $configuratorRegistry->method('add')->willThrowException(new \InvalidArgumentException('make tests!'));

        $serviceRegistry = $this->getMockBuilder(ServiceRegistryInterface::class)->getMock();
        $serviceRegistry->method('get')->willThrowException(new \InvalidArgumentException('make tests!'));
        $serviceRegistry->method('add')->willThrowException(new \InvalidArgumentException('make tests!'));

        $serviceManager = $this->getMockBuilder(ServiceManagerInterface::class)->getMock();
        $serviceManager->method('get')->willThrowException(new \InvalidArgumentException('make tests!'));
        $serviceManager->method('build')->willThrowException(new \InvalidArgumentException('make tests!'));
        $serviceManager->method('getServiceManagerConfig')->willThrowException(new \InvalidArgumentException('make tests!'));
        $serviceManager->method('getServiceManagerSetup')->willThrowException(new \InvalidArgumentException('make tests!'));
        $serviceManager->method('getFactoryResolver')->willThrowException(new \InvalidArgumentException('make tests!'));
        $serviceManager->method('getServices')->willThrowException(new \InvalidArgumentException('make tests!'));

        $test = new Package();

        $test->configure($configuratorRegistry);
        $test->addServices($serviceRegistry);
        $test->boot($serviceManager);

        $this->assertSame([SubscriberBootstrapItem::class], $this->package->getBootstrapItems());
        $this->assertNull($this->package->getConfigProvider());
        $this->assertSame(
            \dirname(\dirname(__DIR__)) . '/src/../bootstrap/',
            $this->package->getBootstrapDirectory()
        );
        $this->assertNull($this->package->getConfigDirectory());
        $this->assertNull($this->package->getDependencies());
    }
}
