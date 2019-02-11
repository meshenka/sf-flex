<?php

namespace App\Domain\LastSeen;

use App\Domain\LastSeen\Model\UserLastSeen;


interface UserLastSeenStore {

    /**
     *
     * @param string $id
     *
     * @return UserLastSeen
     * @throws App\Domain\LastSeen\Execption\UserLastSeenNotFound
     */
    public function find(string $id) : UserLastSeen;

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