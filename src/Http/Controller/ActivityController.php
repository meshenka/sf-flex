<?php

namespace App\Http\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Domain\LastSeen\UseCase\Request\AddActivityRequest;
use App\Domain\LastSeen\UseCase\AddActivity;
use App\Domain\LastSeen\UseCase\GetActivity;
use App\Domain\LastSeen\UseCase\Request\GetActivityRequest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use App\Http\Form\ActivityType;
use App\Http\Form\ActivityDto;

/**
 * @Route("/api")
 */
class ActivityController extends AbstractFOSRestController
{
    /** @var AddActivity */
    private $addActivityUseCase;

    /** @var GetActivity */
    private $getActivityUseCase;

    public function __construct(AddActivity $addActivityUseCase, GetActivity $getActivityUseCase)
    {
        $this->addActivityUseCase = $addActivityUseCase;
        $this->getActivityUseCase = $getActivityUseCase;
    }

    /**
     * @Route("/users/{userId}", name="user_is_online", methods="GET")
     *
     * response body is a JSON
     * {
     *  "userId" <string>,
     *  "online" <bool>
     *  "lastSeen"  <DateTime\RFC3339 string> | "null"
     *  "knowned" <bool>
     * }
     *
     * Example for an user system do not know (notice lastSeen and knowned):
     * <code>
     * {
     *  "userId": "dan@thedog.fr",
     *  "online": "false",
     *  "lastSeen": "null",
     *  "knowned": "false"
     * }
     * </code>
     *
     * Example for an user knowned to the system
     * <code>
     * {
     *  "userId": "john@thedog.fr",
     *  "online": "true",
     *  "lastSeen": 2019-02-12T15:28:05+01:00",
     *  "knowned": "true"
     * }
     * </code>
     */
    public function isOnline(string $userId)
    {
        $useCaseRequest = new GetActivityRequest($userId);
        $response = $this->getActivityUseCase->execute($useCaseRequest);

        $data = [
            "userId" => $response->getId(),
            "online" => $response->isOnline(),
            "lastSeen" => $response->getLastSeen(),
            "knowned" => $response->isKnowned()
        ];

        return $this->view($data, Response::HTTP_OK);
    }

    /**
     * @Route("/users/{userId}", name="user_add_activity", methods="PUT")
     *
     * Request body is a JSON, as presented in example:
     * <code>
     * {
     *  "date" : "2019-02-13T16:11:46+01:00"
     * }
     * </code>
     *
     * with date is a RFC3339 formated date.
     *
     */
    public function addActivity(string $userId, Request $request)
    {
        $form = $this->createForm(ActivityType::class, new ActivityDto(), array('method' => Request::METHOD_PUT));
        $form->submit($request->request->all());

        if (false === $form->isValid()) {
            return $this->view($form);
        }

        $activity = $form->getData();

        $useCaseRequest = new AddActivityRequest($userId, $activity->getDate());
        $this->addActivityUseCase->execute($useCaseRequest);

        return $this->view(null, Response::HTTP_NO_CONTENT);
    }
}
