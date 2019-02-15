<?php

namespace App\Domain\LastSeen\UseCase;

use App\Domain\LastSeen\Exception\UserLastSeenNotFound;
use App\Domain\LastSeen\UserLastSeenStore;
use App\Domain\LastSeen\UseCase\Request\GetLastSeenRequest;
use App\Domain\LastSeen\UseCase\Response\GetLastSeenResponse;
use App\Domain\LastSeen\Model\UserLastSeen;
use App\Domain\LastSeen\UseCase\Response\AddActivityResponse;
use Psr\Log\LoggerInterface;

class GetLastSeen
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

    public function execute(GetLastSeenRequest $request) : GetLastSeenResponse
    {
        try {
            /** @var UserLastSeen */
            $user = $this->userStore->findUser($request->getUserId());

            return new GetLastSeenResponse($user->isOnline(), $user->getLastSeen());
        } catch (UserLastSeenNotFound $ex) {
            $this->logger->warning("Requested user id unknown", ['userId' => $request->getUserId()]);
            // user is not known let's assume he is offline :D
            // @todo may be seperate responsability and provide 2 classes of responses
            return new GetLastSeenResponse(false);
        }
    }
}
