<?php

namespace App\Domain\LastSeen\Exception;

class ActivityNotFound extends \Exception
{
    
    /** @var string */
    public $userId;
    
    public function __construct(string $userId)
    {
        parent::__construct('Activity not found for this id');
        $this->userId = $userId;
    }

    /**
     * Get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
