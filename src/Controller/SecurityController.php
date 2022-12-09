<?php

namespace App\Controller;

use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\RegistrationCompanyType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'security.login', methods:['GET', 'POST'])]
    public function login(): Response
    {

        return $this->render('security/login.html.twig', [
            'controller_name' => 'SecurityController',
           
        ]);
    }

    #[Route('/logout', 'security.logout')]
    public function logout()
    {
        
    }

    #[Route('/register', 'security.registration', methods: ['GET', 'POST'])]
    public function registration(Request $request, EntityManagerInterface $manager):Response
    {
        $user = new User();
        $user->setRole(['ROLE_USER']);
        $form = $this->createForm(RegistrationType::class, $user);

        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('security.login');
        }
        
        return $this->render('security/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/registerCompany', 'security.registrationCompany', methods:['GET','POST'])]
    public function registrationCompany(Request $request, EntityManagerInterface $manager):Response
    {
        $user = new User();
        $user->setRole(['ROLE_COMPANY']);
        $form = $this->createForm(RegistrationCompanyType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('security.login');
        }
        
        return $this->render('security/registrationCompany.html.twig', [
            'form' => $form->createView()
        ]);

    }

    #[Route('/editprofile', 'security.editAccount', methods:['GET','POST'])]
    public function editProfil(Request $request, EntityManagerInterface $doctrine): Response
    {

        
        $user = $this->getUser();
        $form = $this->createForm(RegistrationType::class, $user)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $doctrine->flush();
            return $this->redirectToRoute('home.index');
        }

        return $this->render('security/editAccount.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
