<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterChoiceController extends AbstractController
{
    #[Route('/register_choice', name: 'app_register_choice')]
    public function index(): Response
    {
        return $this->render('security/register_choice.html.twig', [
            'controller_name' => 'RegisterChoiceController',
        ]);
    }
}
