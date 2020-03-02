<?php

namespace App\Domain\LastSeen\Event;

use App\Domain\LastSeen\Model\UserLastSeen;

abstract class AbstractEvent
{
    /** @var string */
    private $id;

    /** @var \DateTimeImmutable */
    private $lastSeen;

    /** @var \DateTimeImmutable */
    private $timestamp;

    public function __construct(UserLastSeen $user) 
    {
        $this->setTimestamp( new \DateTimeImmutable());
        $this->setId($user->getId());
        $this->setLastSeen(\DateTimeImmutable::createFromMutable($user->getLastSeen()));
    }

    /**
     * Get the value of id
     */ 
    public function getId() : string
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    protected function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of lastSeen
     */ 
    public function getLastSeen(): \DateTimeImmutable
    {
        return $this->lastSeen;
    }

    /**
     * Set the value of lastSeen
     *
     * @return  self
     */ 
    protected function setLastSeen($lastSeen)
    {
        $this->lastSeen = $lastSeen;

        return $this;
    }

    /**
     * Get the value of timestamp
     */ 
    public function getTimestamp() : \DateTimeImmutable
    {
        return $this->timestamp;
    }

    /**
     * Set the value of timestamp
     *
     * @return  self
     */ 
    protected function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }
}