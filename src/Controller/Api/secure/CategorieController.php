<?php


namespace App\Controller\Api\secure;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieController extends AbstractController
{
        /////////////ici je cree la route pour la categorie///////////
        #[Route('/api/categorie', name: 'api_categorie', methods:["POST", "GET"])]

        public function categorie(): JsonResponse
        {
            return new JsonResponse( data: 'categorie');
        }
}