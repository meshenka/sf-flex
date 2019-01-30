<?php
/**
 * @author Sylvain Gogel <sylvain.gogel@gmail.com>
 * @license MIT
 * 
 */
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

    /**
     * getName
     *
     * @return string
     */
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


    /**
     * Set the value of id
     *
     * @param  int  $id
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set the value of price
     *
     * @param  float  $price
     *
     * @return  self
     */ 
    public function setPrice(float $price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Set the value of description
     *
     * @param  string  $description
     *
     * @return  self
     */ 
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }
}