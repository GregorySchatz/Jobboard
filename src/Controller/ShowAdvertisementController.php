<?php

namespace App\Controller;

use App\Repository\AdvertisementRepository;
use App\Repository\JobApplicationRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class ShowAdvertisementController extends AbstractController
{
    #[Route('/advertisements', name: 'app_show_advertisement')]
    public function index(Security $security, ManagerRegistry $doctrine): Response
    {
        $adRepos = new AdvertisementRepository($doctrine);
        $companyId = $security->getUser()->CompanyId->getId();
        $ads = $adRepos->getAdvertisementByCompany($companyId);
        return $this->render('showAdvertisement.html.twig', [
            'ads' => $ads,
        ]);
    }

    #[Route('/deleteshowadvertisement/{id}', name: 'app_delete_advertisement_by_id')]
    public function deleteAdvertisement($id, Security $security, ManagerRegistry $doctrine): Response
    {
        $adRepos = new AdvertisementRepository($doctrine);
        $jobappRepos = new JobApplicationRepository($doctrine);
        $jobApp = $jobappRepos->findOneBy(['AdvertisementId' => $id]);
        if ($jobApp) {
            $jobappRepos->deleteJobApplicationsByAdvertisement($jobApp);
        }
        $ad = $adRepos->find($id);

        $adRepos->remove($ad, true);



        return $this->redirectToRoute('app_show_advertisement');
    }

    // #[Route('/editshowadvertisement/{id}', name: 'app_edit_advertisement_by_id')]
    // public function editAdvertisement($id, Security $security, ManagerRegistry $doctrine): Response
    // {
    //     $adRepos = new AdvertisementRepository($doctrine);
    //     $ad = $adRepos->find($id);
    //     return $this->render('editAdvertisement.html.twig', [
    //         'ad' => $ad,
    //     ]);
    // }
}
