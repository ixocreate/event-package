<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace IxocreateTest\Event;

use Ixocreate\Event\Event;
use PHPUnit\Framework\TestCase;

class EventTest extends TestCase
{
    public function testEvent()
    {
        $event = new Event();
        $event->isPropagationStopped();
        $this->assertIsBool($event->isPropagationStopped());
        $event->stopPropagation();
    }
}
