<?php

namespace App\Domain\LastSeen\UseCase\Response;

interface GetActivityResponse
{
    public function getId(): string;
    public function isOnline() : bool;
    public function getLastSeen() : ?\DateTime;
    public function isKnowned(): bool;
}
