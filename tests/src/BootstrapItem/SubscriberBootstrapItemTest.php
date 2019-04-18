<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Event\BootstrapItem;

use Ixocreate\Application\ConfiguratorInterface;
use Ixocreate\Package\Event\BootstrapItem\SubscriberBootstrapItem;
use PHPUnit\Framework\TestCase;

class SubscriberBootstrapItemTest extends TestCase
{
    private $subscriber;

    public function setUp()
    {
        $this->subscriber = new SubscriberBootstrapItem();
    }

    /**
     * @covers \Ixocreate\Package\Event\BootstrapItem\SubscriberBootstrapItem
     */
    public function testSubscriber()
    {
        $this->assertSame($this->subscriber->getVariableName(), 'subscriber');
        $this->assertSame($this->subscriber->getFileName(), 'subscriber.php');
        $this->assertInstanceOf(ConfiguratorInterface::class, $this->subscriber->getConfigurator());
    }
}
