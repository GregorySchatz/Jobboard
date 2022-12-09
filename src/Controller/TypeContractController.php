<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\TypeContract;

class TypeContractController extends AbstractController
{
    #[Route('/createtype', name: 'app_type_contract')]
    public function createType(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $type = new TypeContract();
        $type->setLabel('CDD');
        $entityManager->persist($type);
        $entityManager->flush();
        return new Response('Saved new type with id '.$type->getLabel());
        

    }
}
