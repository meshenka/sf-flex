<?php

namespace App\Storage;

use App\Domain\LastSeen\ActivityStore;
// use Doctrine\ORM\EntityRepository;
use App\Domain\LastSeen\Exception\ActivityNotFound;
use App\Domain\LastSeen\Model\Activity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ActivityRepository extends ServiceEntityRepository implements ActivityStore
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ActivityEntity::class);
    }

    /**
     *
     *{@inheritDoc}
     */
    public function findUser(string $id)
    {
        $user = $this->find($id);

        if (!$user) {
            throw new ActivityNotFound($id);
        }

        return $user;
    }

    /**
     *
     * @param \App\Domain\LastSeen\Model\Activity $user
     * @return void
     */
    public function persist(Activity $user)
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    /**
     * Produce a new Entity
     *
     * @param string $id
     * @param \DateTime $date
     *
     * @return \App\Domain\LastSeen\Model\Activity
     */
    public function new(string $id, \DateTime $date): Activity
    {
        return (new ActivityEntity())->setId($id)->setLastSeen($date);
    }
}
