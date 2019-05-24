<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Event\Register;

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
