<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Event;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final class EventDispatcher
{
    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * EventDispatcher constructor.
     *
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param string $eventName
     * @param EventInterface $event
     * @return \Symfony\Contracts\EventDispatcher\Event
     */
    public function dispatch(string $eventName, EventInterface $event)
    {
        return $this->dispatcher->dispatch(new EventWrapper($event), $eventName);
    }

    /**
     * @param string|null $eventName
     * @return array
     */
    public function getListeners(string $eventName = null): array
    {
        return $this->dispatcher->getListeners($eventName);
    }

    /**
     * @param string $eventName
     * @param $listener
     * @return int|null
     */
    public function getListenerPriority(string $eventName, $listener): ?int
    {
        return $this->dispatcher->getListenerPriority($eventName, $listener);
    }

    /**
     * @param string|null $eventName
     * @return bool
     */
    public function hasListeners(string $eventName = null): bool
    {
        return $this->dispatcher->hasListeners($eventName);
    }
}
