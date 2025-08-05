<?php

namespace App\Controller\Admin;

use App\Entity\Lerneinheit;
use App\Entity\ModulInhalt;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

/**
 * @extends AbstractCrudController<Lerneinheit>
 */
class LerneinheitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Lerneinheit::class;
    }

    public function configureFilters(Filters $filters): Filters {
        return $filters
            ->add('art')
            ->add('fach')
            ->add('funktion')
            ->add('bezeichnung')
            ->add('jahrgangsstufen');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('art'),
            AssociationField::new('fach'),
            AssociationField::new('funktion'),
            TextField::new('bezeichnung'),
            IntegerField::new('stundenumfang'),
            AssociationField::new('jahrgangsstufen')
        ];
    }
}
