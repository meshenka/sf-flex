<?php

namespace App\Domain\LastSeen\UseCase\Response;

class GetNullActivityResponse implements GetActivityResponse
{
    /** @var string */
    private $id;

   
    public function __construct(string $id)
    {
        $this->id = $id;
    }
    
    /**
     * Get the value of isOnline
     */
    public function isOnline() : bool
    {
        return false;
    }

    /**
     * Get the value of lastSeen
     */
    public function getLastSeen() : ?\DateTime
    {
        return null;
    }

    /**
     * Get the value of id
     */ 
    public function getId(): string
    {
        return $this->id;
    }

    public function isKnowned(): bool 
    {
        return false;
    }
}
