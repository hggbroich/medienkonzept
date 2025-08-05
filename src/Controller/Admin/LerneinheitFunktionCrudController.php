<?php

namespace App\Controller\Admin;

use App\Entity\LerneinheitFunktion;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

/**
 * @extends AbstractCrudController<LerneinheitFunktion>
 */
class LerneinheitFunktionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return LerneinheitFunktion::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('bezeichnung')
        ];
    }

}
