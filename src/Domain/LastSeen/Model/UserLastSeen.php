<?php
/**
 * @author Sylvain Gogel <sylvain.gogel@gmail.com>
 * @license MIT
 * 
 */
namespace App\Domain\LastSeen\Model;

abstract class UserLastSeen {

    /**
     * @var string
     */
    protected $id;

    /**
     * @var \DateTime
     */
    protected $lastSeen;


    /**
     * Get the value of id
     *
     * @return  string
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  string  $id
     *
     * @return  self
     */ 
    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of lastSeen
     *
     * @return  \DateTime
     */ 
    public function getLastSeen()
    {
        return $this->lastSeen;
    }

    /**
     * Set the value of lastSeen
     *
     * @param  \DateTime  $lastSeen
     *
     * @return  self
     */ 
    public function setLastSeen(\DateTime $lastSeen)
    {
        $this->lastSeen = $lastSeen;

        return $this;
    }

    /**
     * Business rule, a User is considered online
     * if lastSeen is 20s old or less 
     *
     * @return bool
     */
    public function isOnline() 
    {
        $onlineTime = (new \DateTime())->modify('-20 seconds');

        return ($this->lastSeen >= $onlineTime) ? true : false;
    }
}
