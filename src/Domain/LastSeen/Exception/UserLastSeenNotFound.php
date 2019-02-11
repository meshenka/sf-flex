<?php

namespace App\Domain\LastSeen\Exception;

class UserLastSeenNotFound extends \Exception {
	
    /** @var string */
    public $userId;
	
    public function __construct(string $userId) {
        $this->userId = $userId;
        parent::__construct('UserLastSeen not found for this id');
    }

    /**
	 * Get the value of userId
     */ 
    public function getUserId()
    {
        return $this->userId;
    }
	
	
    /**
     * Set the value of userId
     *
     * @return  self
     */ 
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }
}
