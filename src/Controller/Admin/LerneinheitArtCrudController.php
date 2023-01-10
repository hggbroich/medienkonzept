<?php

namespace App\Controller\Admin;

use App\Entity\LerneinheitArt;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LerneinheitArtCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return LerneinheitArt::class;
    }

    public function configureFields(string $pageName): iterable {
        return [
            TextField::new('bezeichnung')
        ];
    }
}
