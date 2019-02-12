<?php

namespace App\Storage;

use App\Domain\LastSeen\UserLastSeenStore;
// use Doctrine\ORM\EntityRepository;
use App\Domain\LastSeen\Exception\UserLastSeenNotFound;
use App\Domain\LastSeen\Model\UserLastSeen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UserLastSeenRepository extends ServiceEntityRepository implements UserLastSeenStore {
    
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserLastSeenEntity::class);
    }

    /**
     *
     * @param string $id
     *
     * @return UserLastSeen
     * @throws \App\Domain\LastSeen\Exception\UserLastSeenNotFound
     */
    public function findUser(string $id) : UserLastSeen
    {
        $user = $this->find($id);

        if ( $user) {
            return $user;
        }
        throw new UserLastSeenNotFound($id);
    }

    /**
     * 
     * @param \App\Domain\LastSeen\Model\UserLastSeen $user
     * @return void
     */
    public function persist(UserLastSeen $user)
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
     * @return \App\Domain\LastSeen\Model\UserLastSeen
     */
    public function new(string $id, \DateTime $date): UserLastSeen {
        return (new UserLastSeenEntity())->setId($id)->setLastSeen($date);
    }
}
