<?php

namespace App\Controller\Admin;

use App\Entity\Modul;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

/**
 * @extends AbstractCrudController<Modul>
 */
class ModulCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Modul::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('bezeichnung'),
            AssociationField::new('inhalte')
        ];
    }
}
