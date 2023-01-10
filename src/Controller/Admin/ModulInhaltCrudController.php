<?php

namespace App\Controller\Admin;

use App\Entity\ModulInhalt;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ModulInhaltCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ModulInhalt::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('modul'),
            AssociationField::new('kompetenzstufe'),
            TextField::new('bezeichnung'),
            TextareaField::new('zusammenfassung'),
            AssociationField::new('kompetenzen'),
            AssociationField::new('materialien'),
            AssociationField::new('werkzeuge')
        ];
    }
}
