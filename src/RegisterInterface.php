<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Event\Package;

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
