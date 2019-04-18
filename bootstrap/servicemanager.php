<?php
declare(strict_types=1);

namespace Ixocreate\Package\Event;

/** @var \Ixocreate\ServiceManager\ServiceManagerConfigurator $serviceManager */


use Ixocreate\Package\Event\Factory\EventDispatcherFactory;
use Ixocreate\Package\Event\Subscriber\SubscriberSubManager;

$serviceManager->addService(EventDispatcher::class, EventDispatcherFactory::class);
$serviceManager->addSubManager(SubscriberSubManager::class);
