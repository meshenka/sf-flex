<?php

namespace App\Domain\LastSeen\UseCase;

use App\Domain\LastSeen\Exception\UserLastSeenNotFound;
use App\Domain\LastSeen\UserLastSeenStore;
use App\Domain\LastSeen\UseCase\Request\AddActivityRequest;
use App\Domain\LastSeen\UseCase\Response\AddActivityResponse;
use App\Domain\LastSeen\Model\UserLastSeen;
use Psr\Log\LoggerInterface;

class AddActivity
{

    /** @var UserLastSeenStore */
    private $userStore;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(UserLastSeenStore $userStore, LoggerInterface $logger)
    {
        $this->userStore = $userStore;
        $this->logger = $logger;
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
                $this->logger->info('Activity updated', ['id' => $request->getUserId()]);
            }
        } catch (UserLastSeenNotFound $ex) {
            $user = $this->userStore->new($request->getUserId(), $request->getDate());
            $this->userStore->persist($user);
            $this->logger->info('Activity created', ['id' => $request->getUserId()]);
        }

        //there is no data carried out of the response
        return new AddActivityResponse();
    }
}
