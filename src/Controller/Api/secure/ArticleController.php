<?php


namespace App\Controller\Api\secure;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    /////////////ici je cree la route pour le article///////////
    #[Route('/api/article', name: 'api_article', methods:["POST", "GET"])]

    public function login(): JsonResponse
    {
        return new JsonResponse( data: 'article');
    }
}