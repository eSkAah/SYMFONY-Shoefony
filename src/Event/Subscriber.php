<?php

namespace App\Event\Subscriber;

use App\Event\ContactCreated;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class ContactSubscriber implements  EventSubscriberInterface
{
    public static function getSubscribedEvents():array
    {
        // TODO: Implement getSubscribedEvents() method.
        return [
            ContactCreated::class => [
                ['sendEmail', 10],
                ['sendNotification', 5],
            ],
        ];
    }

    public function  sendEmail(ContactCreated $event):void
    {

    }

    public function sendNotification(ContactCreated $event):void
    {

    }
}