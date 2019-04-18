<?php
declare(strict_types=1);

namespace Ixocreate\Event;

/** @var \Ixocreate\ServiceManager\ServiceManagerConfigurator $serviceManager */


use Ixocreate\Event\Factory\EventDispatcherFactory;
use Ixocreate\Event\Subscriber\SubscriberSubManager;

$serviceManager->addService(EventDispatcher::class, EventDispatcherFactory::class);
$serviceManager->addSubManager(SubscriberSubManager::class);
