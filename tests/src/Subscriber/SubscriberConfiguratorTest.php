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

        $subscriberConfig->addDirectory('/Users/jjost/develop/ixocreate/event/src/../bootstrap/Test.php', false);

        $subscriberConfig->addSubscriber('');


        $subscriberConfig->registerService($serviceRegistry);

        $this->assertIsBool(true);
    }
}
