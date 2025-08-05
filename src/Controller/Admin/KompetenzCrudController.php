<?php

namespace App\Controller\Admin;

use App\Entity\Kompetenz;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

/**
 * @extends AbstractCrudController<Kompetenz>
 */
class KompetenzCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Kompetenz::class;
    }

    public function configureFilters(Filters $filters): Filters {
        return $filters
            ->add('kompetenzbereich');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('kompetenzbereich'),
            IntegerField::new('laufendeNummer'),
            TextField::new('bezeichnung'),
            TextareaField::new('beschreibung')
        ];
    }
}
