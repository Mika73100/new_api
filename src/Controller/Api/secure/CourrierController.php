<?php


namespace App\Controller\Api\secure;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CourrierController extends AbstractController
{
        /////////////ici je cree la route pour le courrier///////////
        #[Route('/api/courrier', name: 'api_courrier', methods:["POST", "GET"])]

        public function courrier(): JsonResponse
        {
            return new JsonResponse( data: 'courrier');
        }
}