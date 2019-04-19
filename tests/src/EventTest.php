<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Event;

use Ixocreate\Event\Event;
use PHPUnit\Framework\TestCase;

class EventTest extends TestCase
{
    public function testEvent()
    {
        $event = new Event();
        $this->assertFalse($event->isPropagationStopped());
    }

    public function testEventStopPropagation()
    {
        $event = new Event();
        $event->stopPropagation();
        $this->assertTrue($event->isPropagationStopped());
    }
}
