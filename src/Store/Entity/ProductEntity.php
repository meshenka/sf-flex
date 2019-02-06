<?php 
/**
 * A Product Entity
 * 
 * no annotations, to seperate Domain from Specific lib we must use 
 * manual configuration
 * 
 * @author Sylvain Gogel <sylvain.gogel@gmail.com>
 * @see http://fabien.potencier.org/symfony4-demo.html
 */
namespace App\Store\Entity;

use App\Domain\Model\Product;

/**
 * Doctrine mapping can be found  <src/Resources/config/doctrine/Product.orm.yaml>
 * @see src/Resources/config/doctrine/store/ProductEntity.orm.yaml 
 */
class ProductEntity extends Product
{

    protected $slug;

    /**
     * Get the value of slug
     */ 
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * Set the value of slug
     *
     * @return  self
     */ 
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }
}
