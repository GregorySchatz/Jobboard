<?php

namespace App\Controller\Admin;

use App\Entity\Company;
use App\Entity\JobApplication;
use App\Entity\User;
use App\Entity\Advertisement;
use App\Entity\TypeContract;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use App\Entity\Status;


class DashboardController extends AbstractDashboardController
{

    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {

    }
    
        
    

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        $url = $this->adminUrlGenerator->setController(AdvertisementCrudController::class)->generateUrl();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($url);

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('T WEB 501 NCY 5 1 Jobboard Gregory Schatz');
    }

    public function configureMenuItems(): iterable
    {

        // yield MenuItem::section('Company');
        yield MenuItem::subMenu('Company', 'fa fa-building')->setSubItems([
            MenuItem::linkToCrud('Create company', 'fa fa-plus', Company::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show companies', 'fa fa-eye', Company::class),
        ]);

        // yield MenuItem::section('User');
        yield MenuItem::subMenu('User', 'fa fa-user')->setSubItems([
            MenuItem::linkToCrud('Create user', 'fa fa-plus', User::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show users', 'fa fa-eye', User::class),
        ]);

        // yield MenuItem::section('Advertisement');
        yield MenuItem::subMenu('Advertisement', 'fa fa-bullhorn')->setSubItems([
            MenuItem::linkToCrud('Create advertisement', 'fa fa-plus', Advertisement::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show advertisements', 'fa fa-eye', Advertisement::class),
        ]);

        // yield MenuItem::section('Status');
        yield MenuItem::subMenu('Status', 'fa fa-check')->setSubItems([
            MenuItem::linkToCrud('Create status', 'fa fa-plus', Status::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show status', 'fa fa-eye', Status::class),
        ]);

        // yield MenuItem::section('TypeContract');
        yield MenuItem::subMenu('TypeContract', 'fa fa-file-contract')->setSubItems([
            MenuItem::linkToCrud('Create type contract', 'fa fa-plus', TypeContract::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show type contracts', 'fa fa-eye', TypeContract::class),
        ]);

        // yield MenuItem::section('JobApplication');
        yield MenuItem::subMenu('JobApplication', 'fa fa-file-contract')->setSubItems([
            MenuItem::linkToCrud('Create job application', 'fa fa-plus', JobApplication::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show job applications', 'fa fa-eye', JobApplication::class),
        ]);

      

      




        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
