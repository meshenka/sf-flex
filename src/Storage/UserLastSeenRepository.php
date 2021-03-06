<?php

namespace App\Storage;

use App\Domain\LastSeen\UserLastSeenStore;
use App\Domain\LastSeen\Exception\UserLastSeenNotFound;
use App\Domain\LastSeen\Model\UserLastSeen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserLastSeenRepository extends ServiceEntityRepository implements UserLastSeenStore
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserLastSeenEntity::class);
    }

    /**
     *
     *{@inheritDoc}
     */
    public function findUser(string $id)
    {
        $user = $this->find($id);

        if (!$user) {
            throw new UserLastSeenNotFound($id);
        }

        return $user;
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
    public function new(string $id, \DateTime $date): UserLastSeen
    {
        return (new UserLastSeenEntity())->setId($id)->setLastSeen($date);
    }
}
