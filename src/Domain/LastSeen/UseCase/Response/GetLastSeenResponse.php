<?php

namespace App\Domain\LastSeen\UseCase\Response;

class GetLastSeenResponse {

    /** @var bool */
    private $online;
    
    /** @var \DateTime */
    private $lastSeen;
   
    public function __construct(bool $status, $lastSeen = false)
    {
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
    public function getLastSeen()
    {
        return $this->lastSeen;
    }
}