<?php

namespace App\Domain\LastSeen\UseCase;

use App\Domain\LastSeen\Exception\ActivityNotFound;
use App\Domain\LastSeen\ActivityStore;
use App\Domain\LastSeen\UseCase\Request\AddActivityRequest;
use App\Domain\LastSeen\UseCase\Response\AddActivityResponse;
use App\Domain\LastSeen\Model\Activity;

class AddActivity
{

    /** @var ActivityStore */
    private $userStore;

    public function __construct(ActivityStore $userStore)
    {
        $this->userStore = $userStore;
    }

    public function execute(AddActivityRequest $request) : AddActivityResponse
    {
        // find LastSeen for this user
        // if none found, create a new one and returns
        // else if request->date > user.lastSeen update user and returns
        try {
            /** @var Activity */
            $user = $this->userStore->findUser($request->getUserId());

            if ($request->getDate() > $user->getLastSeen()) {
                $user->setLastSeen($request->getDate());
                $this->userStore->persist($user);
            }
        } catch (ActivityNotFound $ex) {
            $user = $this->userStore->new($request->getUserId(), $request->getDate());
            $this->userStore->persist($user);
        }

        //there is no data carried out of the response
        return new AddActivityResponse();
    }
}
