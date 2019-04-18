<?php
declare(strict_types=1);

namespace Ixocreate\Event\Package;

/** @var \Ixocreate\ServiceManager\ServiceManagerConfigurator $serviceManager */


use Ixocreate\Event\Package\Factory\EventDispatcherFactory;
use Ixocreate\Event\Package\Subscriber\SubscriberSubManager;

$serviceManager->addService(EventDispatcher::class, EventDispatcherFactory::class);
$serviceManager->addSubManager(SubscriberSubManager::class);
