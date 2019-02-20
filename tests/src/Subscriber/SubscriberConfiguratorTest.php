<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace IxocreateTest\Event\Subscriber;

use Ixocreate\Contract\Application\ServiceRegistryInterface;
use Ixocreate\Event\Subscriber\SubscriberConfigurator;
use Ixocreate\ServiceManager\SubManager\SubManagerConfigurator;
use PHPUnit\Framework\TestCase;

class SubscriberConfiguratorTest extends TestCase
{
    public function testGetManagerConfigurator()
    {
        $collector = [];
        $serviceRegistry = $this->createMock(ServiceRegistryInterface::class);
        $serviceRegistry->method('add')->willReturnCallback(function ($name, $object) use (&$collector) {
            $collector[$name] = $object;
        });


        $subscriberConfig = new SubscriberConfigurator();

        $this->assertInstanceOf(SubManagerConfigurator::class, $subscriberConfig->getManagerConfigurator());

        $directory = '/../bootstrap/Test.php';
        $subscriber = 'Test.php';

        $subscriberConfig->addDirectory($directory, false);
        $subscriberConfig->addSubscriber($subscriber);

        $array = (array) $subscriberConfig->getManagerConfigurator();
        $this->assertSame($directory ,$array[' Ixocreate\ServiceManager\AbstractServiceManagerConfigurator directories'][0]['dir'],'Fail: SubscriberConfigurator()->addDirectory');
        $this->assertArrayHasKey($subscriber,$array[' Ixocreate\ServiceManager\AbstractServiceManagerConfigurator factories'], 'Fail: SubscriberConfigurator()->addSubscriber');

        $subscriberConfig->registerService($serviceRegistry);

        $this->assertIsBool(true);
    }
}
