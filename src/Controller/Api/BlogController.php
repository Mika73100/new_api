<?php


namespace App\Controller\Api;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
        /////////////ici je cree la route pour le courrier///////////
        #[Route('/api/blog', name: 'api_blog', methods:["POST", "GET"])]

        public function blog(): JsonResponse
        {
            return new JsonResponse( data: 'blog');
        }
}