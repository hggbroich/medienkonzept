<?php

namespace App\Controller\Admin;

use App\Entity\Fach;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use SebastianBergmann\CodeCoverage\Report\Text;

class FachCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Fach::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('kuerzel'),
            TextField::new('bezeichnung')
        ];
    }

}
