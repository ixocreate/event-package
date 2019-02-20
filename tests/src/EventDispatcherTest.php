<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace IxocreateTest\Event;

use Ixocreate\Contract\ServiceManager\ServiceManagerInterface;
use Ixocreate\Contract\ServiceManager\SubManager\SubManagerInterface;
use Ixocreate\Event\Event;
use Ixocreate\Event\EventDispatcher;
use Ixocreate\Event\Factory\EventDispatcherFactory;
use Ixocreate\Event\Subscriber\SubscriberSubManager;
use IxocreateMisc\Event\Subscriber;
use IxocreateMisc\Event\TestSubscriber;
use PHPUnit\Framework\TestCase;

class EventDispatcherTest extends TestCase
{
    private function Start()
    {
        $factory = new EventDispatcherFactory();

        $container = $this->getMockBuilder(ServiceManagerInterface::class)
            ->getMock();

        Subscriber::setRegister(['event1']);
        $subscriber1 = new Subscriber();

        $container->method("get")
            ->willReturnCallback(function ($requestedName) use ($subscriber1) {
                switch ($requestedName) {
                    case SubscriberSubManager::class:
                        $mock = $this->getMockBuilder(SubManagerInterface::class)->getMock();
                        $mock->method('getServices')->willReturn([Subscriber::class]);
                        $mock->method('get')->willReturnMap([
                            [Subscriber::class, $subscriber1],
                        ]);
                        return $mock;
                }
            });
        /** @var EventDispatcher $dispatcher */
        return $factory($container, EventDispatcher::class, []);
    }

    /**
     * @covers \Ixocreate\Event\EventDispatcher::dispatch
     */
    public function testEventDispatcherDispatch()
    {
        /** @var EventDispatcher $dispachter */
        $dispatcher = $this->Start();
        $dispatcher->dispatch('event1', new Event());
        $this->assertIsBool(true);
    }

    /**
     * @covers \Ixocreate\Event\EventDispatcher::addListener
     */
    public function testEventDispatcherAddListener()
    {
        /** @var EventDispatcher $dispachter */
        $dispatcher = $this->Start();
        $this->expectException(\BadMethodCallException::class);
        $dispatcher->addListener('event1', 'Test');
    }

    /**
     * @covers \Ixocreate\Event\EventDispatcher::removeListener
     */
    public function testEventDispatcherRemoveListener()
    {
        /** @var EventDispatcher $dispachter */
        $dispatcher = $this->Start();
        $this->expectException(\BadMethodCallException::class);
        $dispatcher->removeListener('event1', 'Test');
    }

    /**
     * @covers \Ixocreate\Event\EventDispatcher::addSubscriber
     */
    public function testEventDispatcherAddSubscriber()
    {
        $subscriber = new TestSubscriber();
        /** @var EventDispatcher $dispachter */
        $dispatcher = $this->Start();
        $this->expectException(\BadMethodCallException::class);
        $dispatcher->addSubscriber($subscriber);
    }

    /**
     * @covers \Ixocreate\Event\EventDispatcher::removeSubscriber
     */
    public function testEventDispatcherRemoveSubscriber()
    {
        $subscriber = new TestSubscriber();
        /** @var EventDispatcher $dispachter */
        $dispatcher = $this->Start();
        $this->expectException(\BadMethodCallException::class);
        $dispatcher->removeSubscriber($subscriber);
    }

    public function testEventDispatcherGethas()
    {
        $dispatcher = $this->Start();

        $listener = $dispatcher->getListeners('event1');
        $this->assertNotNull($listener);
        $this->assertNotNull($dispatcher->hasListeners());
        $this->assertSame(0, $dispatcher->getListenerPriority('event1', $listener[0]));
    }
}
