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
use Ixocreate\Contract\Event\SubscriberInterface;

class TestSubscriber implements SubscriberInterface
{
    public static function register(): array
    {
        return [
            'event1',
            'event2',
        ];
    }

    public function handle(EventInterface $event)
    {
        echo 'ich wurde aufgerufen';
    }
}
