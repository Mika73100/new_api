<?php


namespace App\Controller\Api\secure;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PaysController extends AbstractController
{
        /////////////ici je cree la route pour le pays///////////
        #[Route('/api/pays', name: 'api_pays', methods:["POST", "GET"])]

        public function courrier(): JsonResponse
        {
            return new JsonResponse( data: 'pays');
        }
}