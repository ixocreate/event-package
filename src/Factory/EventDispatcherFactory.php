<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Event\Factory;

use Ixocreate\Event\Register\Register;
use Ixocreate\Event\Register\RegisterInterface;
use Ixocreate\Event\Subscriber\SubscriberInterface;
use Ixocreate\ServiceManager\FactoryInterface;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use Ixocreate\Event\EventDispatcher;
use Ixocreate\Event\EventWrapper;
use Ixocreate\Event\Subscriber\SubscriberSubManager;

final class EventDispatcherFactory implements FactoryInterface
{
    /**
     * @param ServiceManagerInterface $container
     * @param $requestedName
     * @param array|null $options
     * @throws \Exception
     * @return mixed
     */
    public function __invoke(ServiceManagerInterface $container, $requestedName, array $options = null)
    {
        $eventDispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();

        /** @var SubscriberSubManager $subscriberSubManager */
        $subscriberSubManager = $container->get(SubscriberSubManager::class);
        /** @var SubscriberInterface $service */
        foreach ($subscriberSubManager->getServices() as $service) {
            $events = $service::register();
            foreach ($events as $currentEvent) {
                if (\is_string($currentEvent)) {
                    $currentEvent = new Register($currentEvent);
                }

                if (!($currentEvent instanceof RegisterInterface)) {
                    throw new \Exception("Invalid value for event registration");
                }
                $eventDispatcher->addListener($currentEvent->name(), function (EventWrapper $event, string $eventName) use ($service, $subscriberSubManager) {
                    $innerEvent = $event->event();
                    $subscriberSubManager->get($service)->handle($innerEvent, $eventName);
                }, $currentEvent->priority());
            }
        }

        return new EventDispatcher($eventDispatcher);
    }
}
