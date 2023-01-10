<?php

namespace App\Controller\Admin;

use App\Entity\MaterialArt;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MaterialArtCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MaterialArt::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('bezeichnung')
        ];
    }
}
