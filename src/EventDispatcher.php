<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Event;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class EventDispatcher
{
    private $dispatcher;

    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     *
     */
    public function dispatch($eventName, Event $event = null)
    {
        return $this->dispatcher->dispatch($eventName, $event);
    }

    /**
     *
     */
    public function addListener($eventName, $listener, $priority = 0)
    {
        throw new \BadMethodCallException('Unmodifiable event dispatchers must not be modified.');
    }

    /**
     *
     */
    public function addSubscriber(EventSubscriberInterface $subscriber)
    {
        throw new \BadMethodCallException('Unmodifiable event dispatchers must not be modified.');
    }

    /**
     *
     */
    public function removeListener($eventName, $listener)
    {
        throw new \BadMethodCallException('Unmodifiable event dispatchers must not be modified.');
    }

    /**
     *
     */
    public function removeSubscriber(EventSubscriberInterface $subscriber)
    {
        throw new \BadMethodCallException('Unmodifiable event dispatchers must not be modified.');
    }

    /**
     *
     */
    public function getListeners($eventName = null)
    {
        return $this->dispatcher->getListeners($eventName);
    }

    /**
     *
     */
    public function getListenerPriority($eventName, $listener)
    {
        return $this->dispatcher->getListenerPriority($eventName, $listener);
    }

    /**
     *
     */
    public function hasListeners($eventName = null)
    {
        return $this->dispatcher->hasListeners($eventName);
    }
}
