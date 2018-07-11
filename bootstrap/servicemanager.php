<?php
declare(strict_types=1);

namespace KiwiSuite\Event;

/** @var \KiwiSuite\ServiceManager\ServiceManagerConfigurator $serviceManager */


use KiwiSuite\Event\Factory\EventDispatcherFactory;
use KiwiSuite\Event\Subscriber\SubscriberSubManager;

$serviceManager->addService(EventDispatcher::class, EventDispatcherFactory::class);
$serviceManager->addSubManager(SubscriberSubManager::class);
