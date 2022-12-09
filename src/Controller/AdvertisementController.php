<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Advertisement;
use App\Entity\Company;
use App\Entity\TypeContract;
use App\Repository\AdvertisementRepository;

class AdvertisementController extends AbstractController
{
    #[Route('/createadvertisement', name: 'app_advertisement')]
    public function createAdvertisement(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $advertisement = new Advertisement();
        $company = $doctrine->getRepository(Company::class)->find(6);
        $type = $doctrine->getRepository(TypeContract::class)->find(2);
        $advertisement->setTitle("Technicien");
        $advertisement->setDescription("Concevoir les imprimantes");
        $advertisement->setWages(1500);
        $advertisement->setWorkingtime(35);
        $advertisement->setCompanyId($company);
        $advertisement->setTypeContractId($type);

        $entityManager->persist($advertisement);
        $entityManager->flush();

        return new Response('Saved new advertisement with id '.$advertisement->getId());

    }

    #[Route('/showadvertisement/{id}', name: 'showadvertisement')]
    public function showAdvertisement(ManagerRegistry $doctrine, int $id): Response
    {
        $advertisement = $doctrine->getRepository(Advertisement::class)->find($id);

        if (!$advertisement) {
            throw $this->createNotFoundException(
                'No advertisement found for id '.$id
            );
        }

        return new Response('Check out this great advertisement: '.$advertisement->getTitle());
    }

    #[Route('/updateadvertisement/{id}', name: 'updateadvertisement')]
    public function updateAdvertisement(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $advertisement = $entityManager->getRepository(Advertisement::class)->find($id);

        if (!$advertisement) {
            throw $this->createNotFoundException(
                'No advertisement found for id '.$id
            );
        }

        $advertisement->setTitle('Développeur Symfony');
        $entityManager->flush();

        return $this->redirectToRoute('showadvertisement', ['id' => $advertisement->getId()]);
    }

    #[Route('/deleteadvertisement/{id}', name: 'deleteadvertisement')]
    public function deleteAdvertisement(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $advertisement = $entityManager->getRepository(Advertisement::class)->find($id);

        if (!$advertisement) {
            throw $this->createNotFoundException(
                'No advertisement found for id '.$id
            );
        }

        $entityManager->remove($advertisement);
        $entityManager->flush();

        return $this->redirectToRoute('showadvertisement', ['id' => $advertisement->getId()]);
    }


    /// On affiche toutes les annonces
    public function showAllAdvertisement(ManagerRegistry $doctrine)
    {
        // On utilise les requêtes effectuées dans AdvertisementRepository
        $radvertisement = new AdvertisementRepository($doctrine);
        
        // On utilise précisément la fonction getAllAvertisementCompany pour récupérer les annonces
        $advertisements = $radvertisement->getAllAdvertisementCompany();

        // Si aucune annonce, ...
        if (!$advertisements) {
            // ... on affiche un message d'erreur
            throw $this->createNotFoundException(
                'No advertisement found'
            );
        }

        // On retourne toutes les annonces récupérées
        return $advertisements;
    }
}
