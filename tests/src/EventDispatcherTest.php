<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Event;

use Ixocreate\Event\Event;
use Ixocreate\Event\EventDispatcher;
use Ixocreate\Event\Factory\EventDispatcherFactory;
use Ixocreate\Event\Subscriber\SubscriberSubManager;
use Ixocreate\Misc\Event\Subscriber;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use Ixocreate\ServiceManager\SubManager\SubManagerInterface;
use PHPUnit\Framework\TestCase;

class EventDispatcherTest extends TestCase
{
    private function getDispatcher(): EventDispatcher
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
        return $factory($container, EventDispatcher::class, []);
    }

    /**
     * @covers \Ixocreate\Event\EventDispatcher::dispatch
     */
    public function testEventDispatcherDispatch()
    {
        $dispatcher = $this->getDispatcher();
        $dispatcher->dispatch('event1', new Event());
        $this->assertIsBool(true);
    }

    public function testEventDispatcherGethas()
    {
        $dispatcher = $this->getDispatcher();

        $listener = $dispatcher->getListeners('event1');
        $this->assertNotNull($listener);
        $this->assertNotNull($dispatcher->hasListeners());
        $this->assertSame(0, $dispatcher->getListenerPriority('event1', $listener[0]));
    }
}
