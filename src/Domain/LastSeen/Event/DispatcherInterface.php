<?php

namespace App\Domain\LastSeen\Event;

interface DispatcherInterface 
{
    public function dispatch(string $eventName, AbstractEvent $event);
}