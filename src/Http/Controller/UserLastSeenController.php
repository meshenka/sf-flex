<?php

namespace App\Http\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Domain\LastSeen\UseCase\Request\AddActivityRequest;
use App\Domain\LastSeen\UseCase\AddActivity;
use App\Domain\LastSeen\UseCase\GetLastSeen;
use App\Domain\LastSeen\UseCase\Request\GetLastSeenRequest;
use FOS\RestBundle\Controller\FOSRestController;

/**
 * @Route("/api")
 */
class UserLastSeenController extends FOSRestController
{
    /** @var AddActivity */
    private $addActivityUseCase;

    /** @var GetLastSeen */
    private $getLastSeenUseCase;

    public function __construct(AddActivity $addActivity, GetLastSeen $getLastSeen)
    {
        $this->addActivityUseCase = $addActivity;
        $this->getLastSeenUseCase = $getLastSeen;
    }

    /**
     * @Route("/users/{userId}", name="user_is_online", methods="GET")
     */
    public function isOnline(string $userId)
    {
        $useCaseRequest = new GetLastSeenRequest($userId);
        $response = $this->getLastSeenUseCase->execute($useCaseRequest);

        $rest = [
            "userId" => $userId, 
            "online" => $response->isOnline(),
            "lastSeen" => $response->getLastSeen()
        ];

        return $this->view($rest, Response::HTTP_OK);
    }

    /**
     * @Route("/users/{userId}", name="user_add_activity", methods="PUT")
     */
    public function addActivity(string $userId, Request $request)
    {
        $useCaseRequest = new AddActivityRequest($userId, new \DateTime($request->get('date')) );
        $this->addActivityUseCase->execute($useCaseRequest); //no need for the useCaseResponse

        return $this->view(null, Response::HTTP_NO_CONTENT);
    }    
}