<?php


namespace App\Controller\Api\secure;

use App\Shared\Globals;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    public Globals $globals;

    public function __construct(Globals $globals)
    {
        $this->globals = $globals;
    }

    /////////////ici je cree la route pour le article///////////
    #[Route('/api/article', name: 'api_article', methods:["POST", "GET"])]

    public function article(): JsonResponse
    {
        return $this->globals->success(['article' => []]);
    }
}