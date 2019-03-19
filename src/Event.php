<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Event;

use Ixocreate\Contract\Event\EventInterface;

class Event extends \Symfony\Component\EventDispatcher\Event implements EventInterface
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
