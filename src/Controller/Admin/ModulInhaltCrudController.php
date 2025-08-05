<?php

namespace App\Controller\Admin;

use App\Entity\ModulInhalt;
use App\Form\ModulInhaltMaterialType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

/**
 * @extends AbstractCrudController<ModulInhalt>
 */
class ModulInhaltCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ModulInhalt::class;
    }

    public function configureFilters(Filters $filters): Filters {
        return $filters
            ->add('modul')
            ->add('kompetenzstufe');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('modul'),
            AssociationField::new('kompetenzstufe'),
            TextField::new('bezeichnung'),
            TextareaField::new('zusammenfassung'),
            AssociationField::new('lerneinheiten'),
            AssociationField::new('kompetenzen'),
            CollectionField::new('materialien')
                ->setEntryType(ModulInhaltMaterialType::class)
                ->allowAdd(true)
                ->allowDelete(true)
                ->setFormTypeOption('by_reference', false),
            AssociationField::new('werkzeuge')
        ];
    }
}
