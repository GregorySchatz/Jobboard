<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Company;
use Doctrine\Persistence\ManagerRegistry;

class CompanyController extends AbstractController
{
    #[Route('/company', name: 'app_company')]
    public function index(): Response
    {
        return $this->render('company/index.html.twig', [
            'controller_name' => 'CompanyController',
        ]);
    }

    #[Route('/createcompany', name: 'newcompany')]
    public function createCompany(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $company = new Company();
        $company->setName('EPSON');
        $company->setSiret(22255588);

        $entityManager->persist($company);
        $entityManager->flush();

        return new Response('Saved new company with id '.$company->getId());
    }

    #[Route('/showcompany/{id}', name: 'showcompany')]
    public function showCompany(ManagerRegistry $doctrine, int $id): Response
    {
        $company = $doctrine->getRepository(Company::class)->find($id);

        if (!$company) {
            throw $this->createNotFoundException(
                'No company found for id '.$id
            );
        }

        return new Response('Check out this great company: '.$company->getName());
    }

    #[Route('/updatecompany/{id}', name: 'updatecompany')]
    public function updateCompany(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $company = $entityManager->getRepository(Company::class)->find($id);

        if (!$company) {
            throw $this->createNotFoundException(
                'No company found for id '.$id
            );
        }

        $company->setName('Apple');
        $entityManager->flush();

        return $this->redirectToRoute('showcompany', ['id' => $company->getId()]);
    }

    #[Route('/deletecompany/{id}', name: 'deletecompany')]
    public function deleteCompany(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $company = $entityManager->getRepository(Company::class)->find($id);

        if (!$company) {
            throw $this->createNotFoundException(
                'No company found for id '.$id
            );
        }

        $entityManager->remove($company);
        $entityManager->flush();

        return $this->redirectToRoute('app_company');
    }

    public function showAllCompany(ManagerRegistry $doctrine)
    {
        $company = $doctrine->getRepository(Company::class)->findAll();

        if (!$company) {
            throw $this->createNotFoundException(
                'No company found'
            );
        }

        return $company;
    }
}
