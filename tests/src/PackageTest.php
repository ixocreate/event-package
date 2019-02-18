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
        $ConfiguratorRegistry = $this->getMockBuilder(ConfiguratorRegistryInterface::class)->getMock();
        $ServiceRegistry = $this->getMockBuilder(ServiceRegistryInterface::class)->getMock();
        $ServiceManager = $this->getMockBuilder(ServiceManagerInterface::class)->getMock();

        $test = new Package();

        $test->configure($ConfiguratorRegistry);
        $test->addServices($ServiceRegistry);
        $test->boot($ServiceManager);

        $this->assertSame([SubscriberBootstrapItem::class], $this->package->getBootstrapItems());
        $this->assertNull($this->package->getConfigProvider());
        $this->assertSame(
            '/Users/jjost/develop/ixocreate/event/src/../bootstrap/',
            $this->package->getBootstrapDirectory()
        );
        $this->assertNull($this->package->getConfigDirectory());
        $this->assertNull($this->package->getDependencies());
    }
}