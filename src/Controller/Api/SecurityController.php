<?php


namespace App\Controller\Api;

use App\Entity\TUser;
use App\Shared\Globals;
use App\Shared\ErrorHttp;
use App\Repository\TPaysRepository;
use App\Repository\TUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;
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
    /**
    *   @param PasswordHasherInterface $passwordhasher
    */
    #[Route('/api/login', name: 'api_login', methods:["POST", "GET"])]
    public function login(): JsonResponse
    {
        $data = $this->globals->jsondecode();
        if (!isset(
            $data->username,
            $data->password,
            ))

        return $this->globals->error( errorHttp: ErrorHttp::ERROR);

        $user = $this->userRepo->findOneBy(['username' => $data->username]);

        //je verifie si USER existe:
        if (!$user) $this->globals->error( errorHttp: ErrorHttp::USERNAME_EXIST);

        //je verifie si le password et juste:
        // if (!$passwordhasher -> verify($user->getPassword(), $data->password)) 
        //     return new JsonResponse( data: 'password invalid', status: 500);
        
        return new JsonResponse([
            'username' => $user->getUsername(),
            'password' => $user->getPassword()
        ]);
    }


    /////////////ici je cree la route pour le register///////////
    /**
    *   @param PasswordHasherInterface $passwordhasher
    */
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
        
        //ici l erreur evoque les champs du formulaire ne sont pas tous remplis.
        return $this->globals->error( errorHttp: ErrorHttp::FROM_INVALID);

        //ici l erreur si l username n est déjà enregistrer
        if($this->userRepo->findOneBy(['username' => $data->username]) != null)
        return $this->globals->error( errorHttp: ErrorHttp::USERNAME_EXIST);

        //ici l erreur si le mots de passe a moin de 4caractères.
        if(strlen($data->password) < 4)
        return $this->globals->error( errorHttp: ErrorHttp::PASSWORD_TOO_SHORT);
        
        //ici je verifie que le pays existe bien
        $fk_pays = $this->paysRepo->findOneBy(['id' => $data->fk_pays, 'active' => true]);
        if (!$fk_pays) return $this->globals->error( errorHttp: ErrorHttp::PAYS_NOT_FOUND);

        $user = (new TUser())
            ->setActive( active: true )
            ->setUsername( $data -> username )
            ->setFirstname( $data -> firstname )
            ->setLastname( $data -> lastname )
            ->setFkPays( $fk_pays );
            //->setDateSave( new \DateTime());
            

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->globals->success( message: 'register done !', data: $user->tojson());
    }
}