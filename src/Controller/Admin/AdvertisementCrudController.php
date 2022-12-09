<?php

namespace App\Controller\Admin;

use App\Entity\Advertisement;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class AdvertisementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Advertisement::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('Title'),
            TextField::new('Description'),
            IntegerField::new('Wages'),
            IntegerField::new('Workingtime'),
            AssociationField::new('CompanyId')->autocomplete(),
            AssociationField::new('TypeContractId')->autocomplete(),

        ];
    }
    
}
