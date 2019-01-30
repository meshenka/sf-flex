<?php
/**
 * @author Sylvain Gogel <sylvain.gogel@gmail.com>
 * 
 */
namespace App\Store\Repository;

use Doctrine\ORM\EntityRepository;
use App\Domain\Store\ProductStoreInterface;
use App\Domain\Model\Product;
use Doctrine\ORM\EntityManagerInterface;
use App\Store\Entity\ProductEntity;


/**
 * ProductRepository
 * 
 * We use a slightly different technics than literature as we want the repository as services
 * but EntityRepository are created by doctrine so we must rely on composition over inheritance
 * 
 * @see https://blog.fervo.se/blog/2017/07/06/doctrine-repositories-autowiring/ 
 * 
 */
class ProductRepository implements ProductStoreInterface
{

    /** @var EntityRepository */
    protected $repository;

    /**
     * __construct
     *
     * @param  EntityManagerInterface $em
     *
     * @return void
     */
    public function __construct(EntityManagerInterface $em) 
    {
        $this->repository = $em->getRepository(ProductEntity::class);
    }

    /**
     * findAllOrderedByName
     *
     * @return void
     */
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM ProductEntity p ORDER BY p.name ASC'
            )
            ->getResult();
    }

    /**
     * find
     *
     * @param  int $id
     *
     * @return Product
     */
    public function find(int $id) : Product
    {
        return $this->repository->find($id);
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