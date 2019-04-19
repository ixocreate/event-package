<?php
declare(strict_types=1);

namespace Ixocreate\Event;

use Ixocreate\Application\Service\ServiceManagerConfigurator;
use Ixocreate\Event\Factory\EventDispatcherFactory;
use Ixocreate\Event\Subscriber\SubscriberSubManager;

/** @var ServiceManagerConfigurator $serviceManager */

$serviceManager->addService(EventDispatcher::class, EventDispatcherFactory::class);
$serviceManager->addSubManager(SubscriberSubManager::class);
