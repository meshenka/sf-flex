<?php

namespace App\Http\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class IndexController extends Controller
{
    /**
     * @Route("/", name="app_index", methods="GET")
     */
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }
}