<?php

namespace App\Controller\Admin;

use App\Entity\JobApplication;
use Doctrine\DBAL\Types\IntegerType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class JobApplicationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return JobApplication::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            yield AssociationField::new('AdvertisementId')->autocomplete(),
            yield AssociationField::new('UserId')->autocomplete(),
            yield TextField::new('Firstname'),
            yield TextField::new('Lastname'),
            yield TextField::new('Email'),
            yield IntegerField::new("Phone"),
            yield TextField::new('Message'),
            yield AssociationField::new('StatusId')->autocomplete(),
            
            

        ];
    }
    
}
