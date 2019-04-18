<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Event\Package;

interface SubscriberInterface
{
    /**
     * @return array
     */
    public static function register(): array;

    /**
     * @param EventInterface $event
     * @return mixed
     */
    public function handle(EventInterface $event, string $eventName);
}
