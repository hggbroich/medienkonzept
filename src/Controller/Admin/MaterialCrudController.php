<?php

namespace App\Controller\Admin;

use App\Entity\Material;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

/**
 * @extends AbstractCrudController<Material>
 */
class MaterialCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Material::class;
    }

    public function configureFilters(Filters $filters): Filters {
        return $filters
            ->add('art')
            ->add('verfuegbarkeit');
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
