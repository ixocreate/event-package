<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Event;

use Ixocreate\Contract\Event\EventInterface;

final class EventWrapper extends \Symfony\Component\EventDispatcher\Event
{
    /**
     * @var EventInterface
     */
    private $event;

    /**
     * EventWrapper constructor.
     * @param EventInterface $event
     */
    public function __construct(EventInterface $event)
    {
        $this->setEvent($event);
    }

    /**
     * @param EventInterface $event
     */
    public function setEvent(EventInterface $event): void
    {
        $this->event = $event;
    }

    /**
     * @return EventInterface
     */
    public function event(): EventInterface
    {
        return $this->event;
    }

    /**
     * @return bool
     */
    public function isPropagationStopped()
    {
        return $this->event->isPropagationStopped();
    }

    /**
     *
     */
    public function stopPropagation()
    {
        $this->event->stopPropagation();
    }
}
