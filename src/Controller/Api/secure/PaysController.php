<?php


namespace App\Controller\Api\secure;

use App\Entity\TPays;
use App\Repository\TPaysRepository;
use App\Shared\ErrorHttp;
use App\Shared\Globals;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PaysController extends AbstractController
{
        /////////////ici je cree la route pour le pays///////////
        #[Route('/api/pays', name: 'api_pays', methods:["POST", "GET"])]

        private TPaysRepository $paysRepo;
        private Globals $globals;

        public function __construct(TPaysRepository $paysRepo, Globals $globals)
        {
            $this->globals = $globals;
            $this->paysRepo = $paysRepo;
        }

        ///////////////Cette fonction ramène une liste de pays//////////////////
        #[Route('/api/pays/list', name: 'api_pays_list', methods:["GET"])]
        public function paysList(): JsonResponse
        {
            return $this->globals->success([
                'pays_list' => array_map(function (Tpays $pays){
                    return $pays->tojson();
                }, $this->paysRepo->findBy(['active'=> true]))
            ]);
        }

        ////////////////////////////////////////////////////////////////////////
        #[Route('/api/pays/find', name: 'api_pays_list_find', methods:["GET"])]
        public function paysFindByIdOnGet(Request $request): JsonResponse
        {
            $id = $request->query->get( key: 'id');

            //erreur si je ne trouve pas l'id du pays:
            if (!$id) 
            return $this->globals->error(errorHttp: ErrorHttp::PARAM_GET_NOT_FOUND);

            $pays = $this->paysRepo->findOneBy(['id' => $id, 'active' => true]);
            //erreur si je ne trouve pas le pays:
            if (!$pays) 
            return $this->globals->error(errorHttp: ErrorHttp::PAYS_GET_NOT_FOUND);
            
            return $this->globals->success([
                'pays' => $pays->tojson()
            ]);
            
        }

        
        //Cette fonction ramène un pays en fonction de l ID renseigner dans l URL//
        #[Route('/api/pays/find/{id}', name: 'api_pays_list_find_id', methods:["GET"])]
        public function paysFindByIdOnUrl(int $id): JsonResponse
        {
            //erreur si je ne trouve pas l'id du pays:
            if (!$id) 
            return $this->globals->error(errorHttp: ErrorHttp::PARAM_GET_NOT_FOUND);

            
        ////////Cette fonction ramène un pays en fonction de l id///////////////
            $pays = $this->paysRepo->findOneBy(['id' => $id, 'active' => true]);
            //erreur si je ne trouve pas le pays:
            if (!$pays) 
            return $this->globals->error(errorHttp: ErrorHttp::PAYS_GET_NOT_FOUND);
            
            return $this->globals->success([
                'pays' => $pays->tojson()
            ]);
        }
}