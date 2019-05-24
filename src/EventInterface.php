<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Event;

interface EventInterface
{
    /**
     * @return bool
     */
    public function isPropagationStopped(): bool;

    /**
     *
     */
    public function stopPropagation(): void;
}
