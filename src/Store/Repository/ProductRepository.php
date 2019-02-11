<?php
/**
 * @author Sylvain Gogel <sylvain.gogel@gmail.com>
 * 
 */
namespace App\Store\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Persistence\ObjectRepository;
use App\Domain\Store\ProductStoreInterface;
use App\Domain\Model\Product;
use Doctrine\ORM\EntityManagerInterface;
use App\Store\Entity\ProductEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * ProductRepository
 * 
 * We use a slightly different technics than literature as we want the repository as services
 * but EntityRepository are created by doctrine so we must rely on composition over inheritance
 * 
 * @see https://blog.fervo.se/blog/2017/07/06/doctrine-repositories-autowiring/ 
 * 
 */
class ProductRepository extends ServiceEntityRepository implements ProductStoreInterface
{

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProductEntity::class);
    }

    /**
     * findAllOrderedByName
     *
     * @return mixed
     */
    public function findAllOrderedByName()
    {
        return $this->createQuery(
                'SELECT p FROM ProductEntity p ORDER BY p.name ASC'
            )
            ->getResult();
    }

    /**
     * update
     *
     * @param  Product $product
     *
     * @return void
     */
    public function update(Product $product)  {
        throw new \RuntimeException("Implement this");
    }

    
}