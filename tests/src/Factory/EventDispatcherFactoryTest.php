<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace IxocreateTest\Event\Factory;

use Ixocreate\Contract\Event\SubscriberInterface;
use Ixocreate\Event\Event;
use Ixocreate\Event\EventDispatcher;
use Ixocreate\Event\Factory\EventDispatcherFactory;
use Ixocreate\Event\Subscriber\SubscriberSubManager;
use Ixocreate\ServiceManager\ServiceManager;
use Ixocreate\ServiceManager\ServiceManagerConfig;
use Ixocreate\ServiceManager\ServiceManagerConfigurator;
use Ixocreate\ServiceManager\ServiceManagerSetup;
use Ixocreate\ServiceManager\SubManager\SubManagerConfigurator;
use IxocreateMisc\Event\TestSubscriber;
use PHPUnit\Framework\TestCase;

class EventDispatcherFactoryTest extends TestCase
{
    public function testEventDispatcherFactory()
    {
        $factory = new EventDispatcherFactory();
        $configurator = new SubManagerConfigurator(SubscriberSubManager::class, SubscriberInterface::class);
        $configurator->addService(TestSubscriber::class);

        $subscriberServiceManagerConfig = new ServiceManagerConfig($configurator);
        $services = [];
        $services[SubscriberSubManager::class . '::Config'] = $subscriberServiceManagerConfig;


        $configurator = new ServiceManagerConfigurator();
        $configurator->addSubManager(SubscriberSubManager::class);
        $config = new ServiceManagerConfig($configurator);

        $setup = new ServiceManagerSetup();
        $container = new ServiceManager($config, $setup, $services);

        /** @var EventDispatcher $dispachter */
        $dispachter = $factory($container, EventDispatcher::class, []);

        $dispachter->getListeners();

        $dispachter->dispatch('event1', new Event());

        $this->assertIsBool(true);
    }
}
