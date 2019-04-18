<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Event;

final class Register implements RegisterInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $priority;

    /**
     * Register constructor.
     *
     * @param string $name
     * @param int $priority
     */
    public function __construct(string $name, int $priority = 0)
    {
        $this->name = $name;
        $this->priority = $priority;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function priority(): int
    {
        return $this->priority;
    }
}
