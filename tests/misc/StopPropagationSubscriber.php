<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: jjost
 * Date: 2019-02-18
 * Time: 12:26
 */

namespace Ixocreate\Misc\Event;

use Ixocreate\Package\Event\EventInterface;

class StopPropagationSubscriber extends Subscriber
{
    public function handle(EventInterface $event, string $eventName)
    {
        parent::handle($event, $eventName);
        $event->stopPropagation();
    }
}
