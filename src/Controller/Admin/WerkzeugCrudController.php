<?php

namespace App\Controller\Admin;

use App\Entity\Werkzeug;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

/**
 * @extends AbstractCrudController<Werkzeug>
 */
class WerkzeugCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Werkzeug::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('bezeichnung')
        ];
    }
}
