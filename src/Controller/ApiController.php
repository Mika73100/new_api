<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): JsonResponse
    {
        return new JsonResponse( data: 'Bienvenue sur votre API Rest');
    }

    #[Route('/doc', name: '/documentation')]
    public function apiDoc(): JsonResponse
    {
        return new JsonResponse([
            'title' => 'Api Documentation REST FULL',
            'sous-titre' => [
                "login" => "Rest login",
                "logout" => "Rest logout",
                "register" => "Rest register",
            ]
        ]);
    }
}
