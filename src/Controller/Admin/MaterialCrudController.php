<?php

namespace App\Controller\Admin;

use App\Entity\Material;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MaterialCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Material::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('bezeichnung'),
            TextField::new('quelle'),
            AssociationField::new('art'),
            AssociationField::new('verfuegbarkeit')
        ];
    }
}
