<?php


namespace App\Controller\Api\secure;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
        /////////////ici je cree la route pour le user///////////
        #[Route('/api/user', name: 'api_user', methods:["POST", "GET"])]

        public function user(): JsonResponse
        {
            return new JsonResponse( data: 'user');
        }
}