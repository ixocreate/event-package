<?php
namespace Ixocreate\Event;

use Ixocreate\Contract\Event\EventInterface;

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
