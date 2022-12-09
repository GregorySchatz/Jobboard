<?php

namespace App\Controller\Admin;

use App\Entity\Company;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CompanyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Company::class;
    }

    
    // public function configureFields(string $pageName): iterable
    // {
    //     return [
    //         TextField::new('Firstname'),
    //         TextField::new('Lastname'),
    //         TextField::new('Email'),
    //         IntegerField::new('Phone'),
    //         TextField::new('Password'),
    //         AssociationField::new('CompanyId')->autocomplete(),

    //     ];
    // }
    
}
