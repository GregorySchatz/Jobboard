<?php

namespace App\Controller\Admin;

use App\Entity\TypeContract;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TypeContractCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeContract::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
