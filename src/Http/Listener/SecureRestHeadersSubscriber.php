<?php

namespace App\Http\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\Response;

class SecureRestHeadersSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        return [
           KernelEvents::RESPONSE => [
               ['addHeaders', 0],
           ]
        ];
    }

    /**
     * @see https://github.com/symfony/maker-bundle/issues/158#issuecomment-386792664
     * @see https://github.com/api-platform/core/blob/master/src/EventListener/RespondListener.php#L5
     *
     * @param \Symfony\Component\HttpKernel\Event\FilterResponseEvent $event
     *
     * @return void
     */
    public function addHeaders(FilterResponseEvent $event)
    {
        $response = $event->getResponse();
        $headers = [
            'X-Content-Type-Options' => 'nosniff',
            'X-Frame-Options' => 'deny',
            'Vary' => 'Accept'
        ];

        $response->headers->replace($headers);
    }
}
