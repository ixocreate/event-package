<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Event;

use Ixocreate\Event\Package;
use Ixocreate\Event\Subscriber\SubscriberBootstrapItem;
use PHPUnit\Framework\TestCase;

class PackageTest extends TestCase
{
    /**
     * @covers \Ixocreate\Event\Package
     */
    public function testPackage()
    {
        $package = new Package();

        $this->assertSame([SubscriberBootstrapItem::class], $package->getBootstrapItems());
        $this->assertDirectoryExists($package->getBootstrapDirectory());
        $this->assertEmpty($package->getDependencies());
    }
}
