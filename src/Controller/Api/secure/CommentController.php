<?php


namespace App\Controller\Api\secure;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentController extends AbstractController
{
        /////////////ici je cree la route pour le commentaire///////////
        #[Route('/api/comment', name: 'api_comment', methods:["POST", "GET"])]

        public function comment(): JsonResponse
        {
            return new JsonResponse( data: 'comment');
        }
}