<?php

namespace App\Gateway;

use App\Domain\LastSeen\Event\DispatcherInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface as SymfonyDispatcher;
use App\Domain\LastSeen\Event\AbstractEvent;

/**
 * Glue code for symfony/event-dispatcher
 */
class EventDispatcher implements DispatcherInterface
{
    /** @var SymfonyDispatcher */
    private $dispatcher;

    public function __construct(SymfonyDispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function dispatch(string $eventName, AbstractEvent $event)
    {
        // @todo transform AbstractEvent to a Symfony Event
        $this->dispatcher->dispatch($eventName, $event);
    }
}