<?php

namespace App\Controller;

use App\Shared\Globals;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{   
    public Globals $globals;

    public function __construct(Globals $globals)
    {
        
    }

    #[Route('/', name: 'home')]
    public function index(): JsonResponse
    {
        return $this->globals->success([], message: 'Bienvenue sur votre API Rest');
    }

    #[Route('/doc', name: '/documentation')]
    public function apiDoc(): JsonResponse
    {
        return $this->globals->success([
            'title' => 'Api Documentation REST FULL',
            'sous-titre' => [
                "login" => "Rest login",
                "logout" => "Rest logout",
                "register" => "Rest register",
            ]
        ]);
    }
}
