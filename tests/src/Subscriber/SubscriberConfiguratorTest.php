<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Event\Subscriber;

use Ixocreate\Application\Service\ServiceRegistryInterface;
use Ixocreate\Event\Subscriber\SubscriberConfigurator;
use Ixocreate\Application\Service\SubManagerConfigurator;
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

        $directory = __DIR__ . '/../bootstrap/';
        $subscriber = 'Test.php';

        $subscriberConfig->addDirectory($directory, false);
        $subscriberConfig->addSubscriber($subscriber);

        $subConfig = $subscriberConfig->getManagerConfigurator();

        $subConfig->getDirectories();
        $subConfig->getFactories();

        $this->assertSame([
            [
                'dir' => $directory,
                'recursive' => false,
                'only' => [
                    0 => 'Ixocreate\Event\Subscriber\SubscriberInterface',
                ],
            ],
        ], $subConfig->getDirectories());
        $this->assertArrayHasKey($subscriber, $subConfig->getFactories());

        $subscriberConfig->registerService($serviceRegistry);
    }
}
