<?php

namespace App\Domain\LastSeen;

use App\Domain\LastSeen\Model\UserLastSeen;


interface UserLastSeenStore {

    /**
     *
     * @param string $id
     *
     * @return object
     * @throws \App\Domain\LastSeen\Exception\UserLastSeenNotFound
     */
    public function findUser(string $id);

    /**
     * 
     * @param \App\Domain\LastSeen\Model\UserLastSeen $user
     * @return void
     */
    public function persist(UserLastSeen $user);

    /**
     * Produce a new Entity
     *
     * @param string $id
     * @param \DateTime $date
     *
     * @return \App\Domain\LastSeen\Model\UserLastSeen
     */
    public function new(string $id, \DateTime $date): UserLastSeen;

}