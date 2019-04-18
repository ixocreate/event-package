<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Package\Event;

interface RegisterInterface
{
    /**
     * @return string
     */
    public function name(): string;

    /**
     * @return int
     */
    public function priority(): int;
}
