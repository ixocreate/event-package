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

namespace IxocreateMisc\Event;

use Ixocreate\Contract\Event\EventInterface;

class StopPropagationSubscriber extends Subscriber
{
    public function handle(EventInterface $event)
    {
        parent::handle($event);
        $event->stopPropagation();
    }
}
