<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Role;
use App\Entity\Company;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{

    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    #[Route('/createuser', name: 'app_user')]
    public function createuser(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $user = new User();
        $company = $doctrine->getRepository(Company::class)->find(1);
        $user->setFirstname('Tom');
        $user->setLastname('MAITRET');
        $user->setEmail('tom.maitret@gmail.com');
        $user->setPhone(123456789);

        $hashPassword = $this->hasher->hashPassword($user, 'kitten');


        $user->setPassword($hashPassword);
        $user->setRole(['ROLE_ADMIN']);
        $user->setCompanyId($company);

        $entityManager->persist($user);
        $entityManager->flush();

        return new Response('Saved new user with id '.$user->getId());
        
    }

    #[Route('/showuser/{id}', name: 'showuser')]
    public function showUser(ManagerRegistry $doctrine, int $id): Response
    {
        $user = $doctrine->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id '.$id
            );
        }

        return new Response('Check out this great user: '.$user->getFirstname());
    }

    
}
