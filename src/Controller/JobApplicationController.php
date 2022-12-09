<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\JobApplication;
use App\Repository\JobApplicationRepository;
use Symfony\Component\Security\Core\Security;

class JobApplicationController extends AbstractController
{
    #[Route('/job/createjobapplication', name: 'app_job_application')]
    public function createJobApplication(ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        $jobApplication = new JobApplication();


    }

    #[Route('/showjobapplication/{id}', name: 'showjobapplication')]
    public function showJobApplication(ManagerRegistry $doctrine, int $id): Response
    {
        $jobApplication = $doctrine->getRepository(JobApplication::class)->find($id);

        if (!$jobApplication) {
            throw $this->createNotFoundException(
                'No job application found for id '.$id
            );
        }

        return new Response('Check out this great job application: '.$jobApplication->getTitle());
    }

    #[Route('/updatejobapplication/{id}', name: 'updatejobapplication')]
    public function updateJobApplication(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $jobApplication = $entityManager->getRepository(JobApplication::class)->find($id);

        if (!$jobApplication) {
            throw $this->createNotFoundException(
                'No job application found for id '.$id
            );
        }

        

        $entityManager->flush();

        return $this->redirectToRoute('showjobapplication', [
            'id' => $jobApplication->getId()
        ]);
    }

    #[Route('/deletejobapplication/{id}', name: 'deletejobapplication')]
    public function deleteJobApplication(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $jobApplication = $entityManager->getRepository(JobApplication::class)->find($id);

        if (!$jobApplication) {
            throw $this->createNotFoundException(
                'No job application found for id '.$id
            );
        }

        $entityManager->remove($jobApplication);
        $entityManager->flush();

        return $this->redirectToRoute('showjobapplication', [
            'id' => $jobApplication->getId()
        ]);
    }


    /// On affiche toutes les candidatures
    public function showJobApplicationByCompany(ManagerRegistry $doctrine, Security $security)
    {

        $companyId = $security->getUser()->CompanyId->getId();
        // On utilise les requêtes effectuées dans JobApplicationRepository
        $jobApplication = new JobApplicationRepository($doctrine);
        
        // On utilise précisément la fonction getJobApplicationsByCompany pour récupérer les candidatures
        $jobApplications = $jobApplication->getJobApplicationsByCompany($companyId);

        // Si aucune candidature, ...
        if (!$jobApplications) {
            // ... on affiche un message d'erreur
            throw $this->createNotFoundException(
                'No job application found'
            );
        }

        // On retourne toutes les candidatures récupérées
        return $jobApplications;
    }

    

}
