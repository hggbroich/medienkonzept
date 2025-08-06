<?php

namespace App\Controller\Admin;

use App\Entity\Kompetenzbereich;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

/**
 * @extends AbstractCrudController<Kompetenzbereich>
 */
class KompetenzbereichCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Kompetenzbereich::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('bezeichnung'),
            Numberfield::new('laufendeNummer'),
            ColorField::new('color')->setRequired(false)->setEmptyData(null)
        ];
    }

}
