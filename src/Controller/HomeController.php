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





class HomeController extends AbstractController
{
    #[Route('/', "home.index", methods: ['GET', 'POST'])]

    public function index(Request $request, ManagerRegistry $doctrine, FormFactoryInterface $formFactory, Security $security): Response
    {
        // On exécute la fonction permettant de récupérer toutes les annonces et on la stocke
        $advertisementController = new AdvertisementController();
        // On récupère toutes les annonces
        $allAds = $doctrine->getRepository(Advertisement::class)->findAll();
        if ($allAds) {
            $ads = $advertisementController->showAllAdvertisement($doctrine);

        }
        $forms = [];
        $user = $security->getUser();

        $entityManager = $doctrine->getManager();
        // Pour toutes les annonces ...
        foreach ( $allAds as $ad ) {
            // ... on créé une nouvelle demande
            $jobApplication = new JobApplication($doctrine);
            // ... a chaque demande on associe l'id de l'annonce
            $i = $ad->id;
            // ... on créé un formulaire à chaque nouvel id trouvé d'une annonce
            $forms[$i] = $this->createForm(JobApplicationFormType::class, $jobApplication);
            // ... on rajoute un 'name' différend à chacun de ces formulaires
            $forms[$i] = $formFactory->createNamed('form'.$i, JobApplicationFormType::class, $jobApplication);
            
            $forms[$i]->handleRequest($request);
            if($forms[$i]->isSubmitted() && $forms[$i]->isValid()){
            $user = $forms[$i]->getData();
            $user->setAdvertisementId($ad);
            $entityManager->persist($user);
            $entityManager->flush();}
        }

        foreach ($forms as $key => $value) {
            $forms[$key] = $value->createView();
        }

        // dd($user);
        
        
        
        // On retourne dans notre page, le contenu stocké dans $ads
        if ($allAds) {
            return $this->render('home.html.twig', [
                'ads' => $ads,
                'forms' => $forms,
                'user' => $user,
            ]);
        } else {
            return $this->render('home.html.twig', [
                'ads' => null,
                'forms' => null,
                'user' => $user,
            ]);
        }
    }

    

}



?>