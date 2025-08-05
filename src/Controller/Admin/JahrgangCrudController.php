<?php

namespace App\Controller\Admin;

use App\Entity\Jahrgang;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

/**
 * @extends AbstractCrudController<Jahrgang>
 */
class JahrgangCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Jahrgang::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('bezeichnung')
        ];
    }

}
