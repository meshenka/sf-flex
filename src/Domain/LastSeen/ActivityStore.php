<?php

namespace App\Domain\LastSeen;

use App\Domain\LastSeen\Model\Activity;

interface ActivityStore
{

    /**
     *
     * @param string $id
     *
     * @return object
     * @throws \App\Domain\LastSeen\Exception\ActivityNotFound
     */
    public function findUser(string $id);

    /**
     *
     * @param Activity $activity
     * @return void
     */
    public function persist(Activity $activity);

    /**
     * Produce a new Entity
     *
     * @param string $id
     * @param \DateTime $date
     *
     * @return Activity
     */
    public function new(string $id, \DateTime $date): Activity;
}
