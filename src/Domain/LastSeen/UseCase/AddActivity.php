<?php

namespace App\Domain\LastSeen\UseCase;

use App\Domain\LastSeen\Exception\UserLastSeenNotFound;
use App\Domain\LastSeen\UserLastSeenStore;
use App\Domain\LastSeen\UseCase\Request\AddActivityRequest;
use App\Domain\LastSeen\UseCase\Response\AddActivityResponse;
use App\Domain\LastSeen\Model\UserLastSeen;

class AddActivity {

    /** @var UserLastSeenStore */
    private $userStore;

    public function __construct(UserLastSeenStore $userStore)
    {
        $this->userStore = $userStore;        
    }

    public function execute(AddActivityRequest $request) : AddActivityResponse 
    {
        // find LastSeen for this user
        // if none found, create a new one and returns
        // else if request->date > user.lastSeen update user and returns
        try {
            /** @var UserLastSeen */
            $user = $this->userStore->findUser($request->getUserId());

            if ($request->getDate() > $user->getLastSeen()) {
                $user->setLastSeen($request->getDate());
                $this->userStore->persist($user);
            }
        } catch (UserLastSeenNotFound $ex) {
            // @TODO we cannot new a UserLastSeen as it is an abstract class
            // how to get a new UserLastSeen implementation?
            // the store can produce one?
            // $this->userStore->new($id, $date), ??
            $user = $this->userStore->new($request->getUserId(), $request->getDate());
            $this->userStore->persist($user);
        }

        //there is no data carried out of the response
        return new AddActivityResponse();
 
    }
}