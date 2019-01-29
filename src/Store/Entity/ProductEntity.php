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

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class ProductEntity extends Product
{

}
