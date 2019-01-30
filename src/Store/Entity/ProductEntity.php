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
 * @see src/Resources/config/doctrine/Product.orm.yaml 
 */
class ProductEntity extends Product
{

}
