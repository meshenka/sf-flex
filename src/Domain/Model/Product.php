<?php

namespace App\Domain\Model;

abstract class Product implements ProductInterface {

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var float
     */
    protected $price;

    /**
     * @var string
     */
    protected $description;

    public function getName() : string 
    {
        return $this->name;
    }

    public function getId() : int 
    {
        return $this->id;
    }

    public function getDescription() : string
    {
        return $this->description;
    
    }

    public function getPrice(): float
    {
        return $this->price;
    }

}