<?php

namespace App\Domain\LastSeen\UseCase;

use App\Domain\LastSeen\Exception\ActivityNotFound;
use App\Domain\LastSeen\ActivityStore;
use App\Domain\LastSeen\UseCase\Request\GetActivityRequest;
use App\Domain\LastSeen\UseCase\Response\GetActivityResponse;
use App\Domain\LastSeen\UseCase\Response\GetUserActivityResponse;
use App\Domain\LastSeen\UseCase\Response\GetNullActivityResponse;
use App\Domain\LastSeen\Model\Activity;
use App\Domain\LastSeen\UseCase\Response\AddActivityResponse;
use Psr\Log\LoggerInterface;

class GetActivity
{

    /** @var ActivityStore */
    private $userStore;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(ActivityStore $userStore, LoggerInterface $logger)
    {
        $this->userStore = $userStore;
        $this->logger = $logger;
    }

    public function execute(GetActivityRequest $request) : GetActivityResponse
    {
        try {
            /** @var Activity */
            $user = $this->userStore->findUser($request->getUserId());

            return new GetUserActivityResponse($user->getId(), $user->isOnline(), $user->getLastSeen());
        } catch (ActivityNotFound $ex) {
            $this->logger->warning("Requested user id unknown", ['userId' => $request->getUserId()]);
            // user is not known let's assume he is offline :D
            return new GetNullActivityResponse($request->getUserId());
        }
    }
}
