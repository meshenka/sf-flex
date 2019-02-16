<?php

namespace App\Command\Formatter;

use App\Domain\LastSeen\UseCase\Response\GetActivityResponse;

interface ActivityResponseFormatter
{
    public function getId(): string ;
    public function getLastSeen(): string;
    public function isOnline(): string;
    public function isKnowned(): string;
}
