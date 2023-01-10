<?php

namespace App\Controller\Admin;

use App\Entity\ModulKompetenzstufe;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ModulKompetenzstufeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ModulKompetenzstufe::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('bezeichnung')
        ];
    }
}
