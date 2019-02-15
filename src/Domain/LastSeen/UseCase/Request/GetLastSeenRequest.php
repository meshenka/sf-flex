<?php

namespace App\Domain\LastSeen\UseCase\Request;

class GetLastSeenRequest
{

    /** @var string */
    private $userId;
    
    public function __construct(string $id)
    {
        $this->userId = $id;
    }

    /**
     * Get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
