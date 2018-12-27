<?php
declare(strict_types=1);

namespace Ixocreate\Event\BootstrapItem;

use Ixocreate\Contract\Application\BootstrapItemInterface;
use Ixocreate\Contract\Application\ConfiguratorInterface;
use Ixocreate\Event\Subscriber\SubscriberConfigurator;
use Ixocreate\Resource\SubManager\ResourceConfigurator;

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
