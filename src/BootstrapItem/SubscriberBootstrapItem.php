<?php
declare(strict_types=1);

namespace KiwiSuite\Event\BootstrapItem;

use KiwiSuite\Contract\Application\BootstrapItemInterface;
use KiwiSuite\Contract\Application\ConfiguratorInterface;
use KiwiSuite\Event\Subscriber\SubscriberConfigurator;
use KiwiSuite\Resource\SubManager\ResourceConfigurator;

final class SubscriberBootstrapItem implements BootstrapItemInterface
{
    /**
     * @return mixed
     */
    public function getConfigurator(): ConfiguratorInterface
    {
        return new SubscriberConfigurator();
    }

    /**
     * @return string
     */
    public function getVariableName(): string
    {
        return 'subscriber';
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return 'subscriber.php';
    }
}
