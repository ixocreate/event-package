<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Event\Factory;

use Ixocreate\ServiceManager\ServiceManagerInterface;
use Ixocreate\ServiceManager\SubManager\SubManagerInterface;
use Ixocreate\Event\Package\Event;
use Ixocreate\Event\Package\EventDispatcher;
use Ixocreate\Event\Package\Factory\EventDispatcherFactory;
use Ixocreate\Event\Package\Subscriber\SubscriberSubManager;
use PHPUnit\Framework\TestCase;

class EventDispatcherFactoryTest extends TestCase
{
    public function testEventDispatcherFactoryMocked()
    {
        $subscriber = [
             ['subtype' => 'Subscriber',
                'name' => 'EventDispatcherSubscriber1',
                'event' => ['event1'], ],
             ['subtype' => 'Subscriber',
                'name' => 'EventDispatcherSubscriber2',
                'event' => ['event2'], ],
        ];

        $dispatcher = $this->createDispatcher($subscriber, $instances);

        $dispatcher->dispatch('event1', new Event());
        $dispatcher->dispatch('event2', new Event());

        $this->assertNotNull($instances[0]->getEvent());
        $this->assertNotNull($instances[1]->getEvent());
    }

    public function testEventDispatcherFactoryStopPropagation()
    {
        $subscriber = [
             ['subtype' => 'StopPropagationSubscriber',
                'name' => 'EventDispatcherSubscriberStop1',
                'event' => ['event1'], ],
             ['subtype' => 'Subscriber',
                'name' => 'EventDispatcherSubscriberStop2',
                'event' => ['event1'], ],
        ];

        $dispatcher = $this->createDispatcher($subscriber, $instances);

        $dispatcher->dispatch('event1', new Event());

        $this->assertNotNull($instances[0]->getEvent());
        $this->assertNull($instances[1]->getEvent());
    }

    private function createDispatcher($subscriber, &$instances)
    {
        $factory = new EventDispatcherFactory();

        $container = $this->getMockBuilder(ServiceManagerInterface::class)
            ->getMock();

        $classNames = [];
        $instances = [];
        $returnMap = [];
        foreach ($subscriber as $sub) {
            $className = $this->generateSubscriber($sub['subtype'], $sub['name'], $sub['event']);
            $classNames[] = $className;
            $subscriber = new $className();
            $instances[] = $subscriber;
            $returnMap[] = [$className, $subscriber];
        }

        $container->method("get")
            ->willReturnCallback(function ($requestedName) use ($classNames, $returnMap) {
                switch ($requestedName) {
                    case SubscriberSubManager::class:
                        $mock = $this->getMockBuilder(SubManagerInterface::class)->getMock();
                        $mock->method('getServices')->willReturn($classNames);
                        $mock->method('get')->willReturnMap($returnMap);
                        return $mock;
                }
            });


        /** @var EventDispatcher $dispatcher */
        return $factory($container, EventDispatcher::class, []);
    }

    private function generateSubscriber($subscriberType, $className, array $eventNames)
    {
        $template = <<<'EOF'
<?php
declare(strict_types=1);

namespace Ixocreate\Misc\Event;

use Ixocreate\Event\Package\EventInterface;
use Ixocreate\Event\Package\SubscriberInterface;

class <CLASSNAME> extends \Ixocreate\Misc\Event\<SUBSCRIBERTYPE>
{
    public static function register(): array
    {
        return <EVENTNAMES>;
    }
}
EOF;

        $classCode = \str_replace(['<SUBSCRIBERTYPE>','<CLASSNAME>', '<EVENTNAMES>'], [$subscriberType, $className, \var_export($eventNames, true)], $template);

        $tmpFilename = \tempnam(\sys_get_temp_dir(), 'subscriber_');
        \file_put_contents($tmpFilename, $classCode);
        require $tmpFilename;
        \unlink($tmpFilename);

        return 'Ixocreate\\Misc\Event\\' . $className;
    }
}
