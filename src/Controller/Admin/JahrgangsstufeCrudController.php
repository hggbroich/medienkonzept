<?php

namespace App\Controller\Admin;

use App\Entity\Jahrgangsstufe;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class JahrgangsstufeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Jahrgangsstufe::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('jahrgang'),
            IntegerField::new('halbjahr'),
            TextField::new('bezeichnung')
        ];
    }

}
