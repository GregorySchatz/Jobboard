<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Status;

class StatusController extends AbstractController
{
    #[Route('/createstatus', name: 'app_status')]
    public function createStatus(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $status = new Status();
        $status->setLabel('Pending');
        $entityManager->persist($status);
        $entityManager->flush();
        return new Response('Saved new status with id '.$status->getLabel());
    }
}
