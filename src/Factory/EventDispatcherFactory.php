<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Event\Package\Factory;

use Ixocreate\Event\Package\RegisterInterface;
use Ixocreate\Event\Package\SubscriberInterface;
use Ixocreate\ServiceManager\FactoryInterface;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use Ixocreate\Event\Package\EventDispatcher;
use Ixocreate\Event\Package\EventWrapper;
use Ixocreate\Event\Package\Register;
use Ixocreate\Event\Package\Subscriber\SubscriberSubManager;

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
