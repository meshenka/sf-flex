<?php

namespace App\Storage;

use App\Domain\LastSeen\UserLastSeenStore;
use Doctrine\ORM\EntityRepository;
use App\Domain\LastSeen\Exception\UserLastSeenNotFound;
use App\Domain\LastSeen\Model\UserLastSeen;

class UserLastSeenRepository extends EntityRepository implements UserLastSeenStore {
    
    /**
     *
     * @param string $id
     *
     * @return UserLastSeen
     * @throws App\Domain\LastSeen\Execption\UserLastSeenNotFound
     */
    public function findUser(string $id) : UserLastSeen
    {
        if ($user = $this->find($id != null)) {
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