<?php

namespace App\Command\Formatter;

use App\Domain\LastSeen\UseCase\Response\GetActivityResponse;

// @todo make this a service instead of a statefull class
class GetActivityResponseFormatter extends AbstractActivityResponseFormatter
{
    public function getId(): string
    {
        return $this->response->getId();
    }

    public function getLastSeen(): string
    {
        return ($this->response->isKnowned()) ? $this->response->getLastSeen()->format(\DateTime::RFC3339) : 'null';
    }

    public function isOnline(): string
    {
        return $this->response->isOnline()? 'true': 'false';
    }

    public function isKnowned(): string
    {
        return $this->response->isKnowned()? 'true': 'false';
    }
}
