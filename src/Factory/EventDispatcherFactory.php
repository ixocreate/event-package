<?php
namespace Ixocreate\Event\Factory;

use Ixocreate\Contract\ServiceManager\FactoryInterface;
use Ixocreate\Contract\ServiceManager\ServiceManagerInterface;
use Ixocreate\Event\EventDispatcher;
use Ixocreate\Event\Subscriber\SubscriberSubManager;

final class EventDispatcherFactory implements FactoryInterface
{

    /**
     * @param ServiceManagerInterface $container
     * @param $requestedName
     * @param array|null $options
     * @return mixed
     */
    public function __invoke(ServiceManagerInterface $container, $requestedName, array $options = null)
    {
        $eventDispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();

        /** @var SubscriberSubManager $subscriberSubManager */
        $subscriberSubManager = $container->get(SubscriberSubManager::class);
        foreach ($subscriberSubManager->getServices() as $service) {
            $eventNames = $service::register();

            foreach ($eventNames as $eventName) {
                $eventDispatcher->addListener($eventName, function ($event) use ($service, $subscriberSubManager){
                    $subscriberSubManager->get($service)->handle($event);
                });
            }
        }

        return new EventDispatcher($eventDispatcher);
    }
}
