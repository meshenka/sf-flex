<?php

namespace App\Domain\LastSeen\UseCase\Request;

class AddActivityRequest {
    /** @var string */
    private $userId;

    /** @var \DateTime */
    private $date;
    
    public function __construct(string $id, \DateTime $date)
    {
        $this->userId = $id;
        $this->date = $date;
    }

    /**
     * Get the value of userId
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

}