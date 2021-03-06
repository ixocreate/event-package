<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Event\Subscriber;

use Ixocreate\Event\EventInterface;

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
