<?php

namespace App\Domain\LastSeen\UseCase;

use App\Domain\LastSeen\Exception\UserLastSeenNotFound;
use App\Domain\LastSeen\UserLastSeenStore;
use App\Domain\LastSeen\UseCase\Request\GetLastSeenRequest;
use App\Domain\LastSeen\UseCase\Response\GetLastSeenResponse;
use App\Domain\LastSeen\Model\UserLastSeen;
use App\Domain\LastSeen\UseCase\Response\AddActivityResponse;

class GetLastSeen {

    /** @var UserLastSeenStore */
    private $userStore;

    public function __construct(UserLastSeenStore $userStore)
    {
        $this->userStore = $userStore;        
    }

    public function execute(GetLastSeenRequest $request) : GetLastSeenResponse 
    {
        // find LastSeen for this user
        // if none found
        try {
            /** @var UserLastSeen */
            $user = $this->userStore->findUser($request->getUserId());

            return new GetLastSeenResponse($user->isOnline(), $user->getLastSeen());
       
        } catch (UserLastSeenNotFound $ex) {
            //if user is not known let's assume he is offline :D
            return new GetLastSeenResponse(false);
        }
    }
}