<?php

namespace App\Controller;


use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Company;
use App\Controller\CompanyController;
use App\Controller\AdvertisementController;
use App\Entity\JobApplication;
use App\Form\JobApplicationFormType;
use Symfony\Component\Form\FormFactoryInterface;
use App\Entity\Advertisement;
use App\Form\CreateAdvertisementType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormView;
use Symfony\Component\Security\Core\Security;

class FormAdvertisementController extends AbstractController
{
    #[Route('/newadvertisement', name: 'app_form_advertisement')]
    public function getFormCreateAdvertisement(FormFactoryInterface $formFactory, Request $request, ManagerRegistry $doctrine, Security $security): Response{
        $advertisement = new Advertisement();

        $form = $this -> createForm(CreateAdvertisementType::class, $advertisement);

        $user = $security->getUser();

        $entityManager = $doctrine->getManager();

        $form -> handleRequest($request);

        if ($form -> isSubmitted() && $form -> isValid()) {
            # code...
            $advertisement = $form -> getData();

            $advertisement->CompanyId = $user->CompanyId;
            $entityManager->persist($advertisement);
            $entityManager->flush();
            
        }

        return $this->render('newAdvertisement.html.twig',['ad' => $advertisement, 'form' => $form -> createView()]);
        

        
    }

    
}
