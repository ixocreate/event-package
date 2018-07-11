<?php
namespace KiwiSuite\Event;

use KiwiSuite\Contract\Event\EventInterface;

class Event extends \Symfony\Component\EventDispatcher\Event implements EventInterface
{
    /**
     * @return bool
     */
    public function isPropagationStopped(): bool
    {
        return parent::isPropagationStopped();
    }

    /**
     *
     */
    public function stopPropagation(): void
    {
        parent::stopPropagation();
    }
}
