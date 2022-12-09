<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('Firstname'),
            TextField::new('Lastname'),
            TextField::new('Email'),
            IntegerField::new('Phone'),
            TextField::new("plainPassword"),
            AssociationField::new('CompanyId')->autocomplete(),
            ArrayField::new('Role', 'Possible roles : ROLE_ADMIN, ROLE_USER, ROLE_COMPANY'),
            // ->renderAsBadges([
                
            //     '[ROLE_ADMIN]' => 'info',
            //     '[ROLE_USER]' => 'info',
            //     '[ROLE_COMPANY]' => 'info',
            // ]),

            
            
        ];
    }
    
}
