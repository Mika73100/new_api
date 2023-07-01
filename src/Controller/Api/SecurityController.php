<?php


namespace App\Controller\Api;

use App\Entity\TUser;
use App\Repository\TPaysRepository;
use App\Repository\TUserRepository;
use App\Shared\Globals;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class SecurityController extends AbstractController
{
    private Globals $globals;
    private TPaysRepository $paysRepo;
    private TUserRepository $userRepo;

    public function __construct(Globals $globals, TPaysRepository $paysRepo, TUserRepository $userRepo)
    {
        $this->globals = $globals;
        $this->paysRepo = $paysRepo;
        $this->userRepo = $userRepo;
    }

    /////////////ici je cree la route pour le login///////////
    #[Route('/api/login', name: 'api_login', methods:["POST", "GET"])]

    public function login(): JsonResponse
    {
        $data = $this->globals->jsondecode();
        if (!isset(
            $data->username,
            $data->password,
            ))

        return new JsonResponse( data: 'form invalid', status: 500);

        $user = $this->userRepo->findOneBy(['username' => $data->username]);

        //je verifie si USER existe:
        if (!$user)
            return new JsonResponse( data: 'username not found', status: 500);

        //je verifie si le password et juste:
        // if (!$user) 
        //     return new JsonResponse( data: 'password invalid', status: 500);
        
        return new JsonResponse([
            'username' => $user->getUsername(),
            'password' => $user->getPassword()
        ]);
    }


    /////////////ici je cree la route pour le register///////////
    #[Route('/api/register', name: 'api_register', methods:["POST", "GET"])]

    public function register(EntityManagerInterface $entityManager): JsonResponse
    {
        $data = $this->globals->jsondecode();
        if (!isset(
            $data->username,
            $data->firstname,
            $data->lastname,
            $data->password,
            $data->fk_pays
            ))

        return new JsonResponse( data: 'error', status: 500);


        $fk_pays = $this->paysRepo->findOneBy(['id' => $data->fk_pays, 'active' => true]);
        $user = (new TUser())
            ->setActive( active: true )
            ->setUsername( $data -> username )
            ->setFirstname( $data -> firstname )
            ->setLastname( $data -> lastname )
            ->setFkPays( $fk_pays );
            //->setDateSave( new \DateTime());
            
        $user->setPassword($data->password);

        $entityManager->persist($user);
        $entityManager->flush();

        return new JsonResponse( data: 'register succesfull !');
    }
}