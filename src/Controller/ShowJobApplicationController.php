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
use App\Repository\JobApplicationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormView;
use Symfony\Component\Security\Core\Security;

class ShowJobApplicationController extends AbstractController
{
    #[Route('/showjobapp', name: 'app_show_job_application')]
    public function index(Request $request, ManagerRegistry $doctrine, Security $security): Response
    {
        
        $jobApplicationController = new JobApplicationController();
        $jobRepos = new JobApplicationRepository($doctrine);
        $job = $jobRepos->findAll();
        if ($job) {
            $jobApps = $jobApplicationController->showJobApplicationByCompany($doctrine, $security);
            return $this->render('showJobApplication.html.twig',['jobApps' => $jobApps]);


        }
        else{
            return $this->render('showJobApplication.html.twig');
        }


        // On retourne dans notre page, le contenu stocké dans $jobApps
    }
}
