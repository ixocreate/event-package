<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Event;

class Event extends \Symfony\Contracts\EventDispatcher\Event implements EventInterface
{
    private $propagationStopped = false;

    /**
     * @return bool
     */
    public function isPropagationStopped(): bool
    {
        return $this->propagationStopped;
    }

    /**
     *
     */
    public function stopPropagation(): void
    {
        $this->propagationStopped = true;
    }
}
