<?php

namespace App\Http\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class PingController extends AbstractController
{
    /**
     * @Route("/_internal/healthcheck", name="app_ping", methods="GET")
     */
    public function ping(): Response
    {
        $json = ["status" => "healthy"];

        return new Response(json_encode($json), Response::HTTP_OK, ["Content-Type" => "application/json"]);
    }
}
