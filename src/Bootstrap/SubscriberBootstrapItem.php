<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Event\Package\Bootstrap;

use Ixocreate\Application\Service\Bootstrap\BootstrapItemInterface;
use Ixocreate\Application\Service\Configurator\ConfiguratorInterface;
use Ixocreate\Event\Package\Subscriber\SubscriberConfigurator;

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
