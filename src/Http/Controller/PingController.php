<?php

namespace App\Http\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
/**
 * @Route("/api")
 */
class PingController extends FOSRestController
{
    /**
     * @Route("/_internal/healthcheck", name="app_ping", methods="GET")
     */
    public function ping()
    {
        $data = ["status" => "healthy"];
        return $this->view($data, Response::HTTP_OK);
    }
}