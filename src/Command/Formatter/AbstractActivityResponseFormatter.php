<?php

namespace App\Command\Formatter;

use App\Domain\LastSeen\UseCase\Response\GetActivityResponse;

/**
 * Decorator Pattern
 */
abstract class AbstractActivityResponseFormatter implements ActivityResponseFormatter
{

    /** @var GetActivityResponse */
    protected $response;

    public function __construct(GetActivityResponse $response)
    {
        $this->response = $response;
    }

    abstract public function getId(): string;
    abstract public function getLastSeen(): string;
    abstract public function isOnline(): string;
    abstract public function isKnowned(): string;
}
