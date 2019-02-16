<?php

namespace App\Domain\LastSeen\UseCase\Response;

class GetUserActivityResponse implements GetActivityResponse
{
    /** @var string */
    private $id;

    /** @var bool */
    private $online;
    
    /** @var \DateTime */
    private $lastSeen;
   
    public function __construct(string $id, bool $status, \DateTime $lastSeen)
    {
        $this->id = $id;
        $this->online = $status;
        $this->lastSeen = $lastSeen;
    }
    
    /**
     * Get the value of isOnline
     */
    public function isOnline() : bool
    {
        return $this->online;
    }

    /**
     * Get the value of lastSeen
     */
    public function getLastSeen() : ?\DateTime
    {
        return $this->lastSeen;
    }

    /**
     * Get the value of id
     */
    public function getId() : string
    {
        return $this->id;
    }

    public function isKnowned(): bool
    {
        return true;
    }
}
