<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace IxocreateTest\Event\BootstrapItem;

use Ixocreate\Contract\Application\ConfiguratorInterface;
use Ixocreate\Event\BootstrapItem\SubscriberBootstrapItem;
use PHPUnit\Framework\TestCase;

class SubscriberBootstrapItemTest extends TestCase
{
    private $subscriber;

    public function setUp()
    {
        $this->subscriber = new SubscriberBootstrapItem();
    }

    /**
     * @covers \Ixocreate\Event\BootstrapItem\SubscriberBootstrapItem
     */
    public function testSubscriber()
    {
        $this->assertSame($this->subscriber->getVariableName(), 'subscriber');
        $this->assertSame($this->subscriber->getFileName(), 'subscriber.php');
        $this->assertInstanceOf(ConfiguratorInterface::class, $this->subscriber->getConfigurator());
    }
}
