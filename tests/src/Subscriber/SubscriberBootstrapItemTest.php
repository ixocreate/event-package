<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Event\Subscriber;

use Ixocreate\Application\Configurator\ConfiguratorInterface;
use Ixocreate\Event\Subscriber\SubscriberBootstrapItem;
use PHPUnit\Framework\TestCase;

class SubscriberBootstrapItemTest extends TestCase
{
    private $subscriber;

    public function setUp()
    {
        $this->subscriber = new SubscriberBootstrapItem();
    }

    /**
     * @covers \Ixocreate\Event\SubscriberBootstrapItem
     */
    public function testSubscriber()
    {
        $this->assertSame($this->subscriber->getVariableName(), 'subscriber');
        $this->assertSame($this->subscriber->getFileName(), 'subscriber.php');
        $this->assertInstanceOf(ConfiguratorInterface::class, $this->subscriber->getConfigurator());
    }
}
