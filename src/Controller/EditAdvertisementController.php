<?php

namespace App\Controller;

use App\Entity\Advertisement;
use App\Form\CreateAdvertisementType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\RegistrationType;
use Doctrine\Persistence\ManagerRegistry;

class EditAdvertisementController extends AbstractController
{
    #[Route('/editadvertisement/{id}', name: 'app_edit_advertisement', methods:['GET', 'POST'])]
    public function editProfil(Request $request, ManagerRegistry $doctrine, int $id): Response
    {

        $entityManager = $doctrine->getManager();
        $advertisement = $entityManager->getRepository(Advertisement::class)->find($id);

        $form = $this->createForm(CreateAdvertisementType::class, $advertisement)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_show_advertisement');
        }

        return $this->render('edit_advertisement.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
