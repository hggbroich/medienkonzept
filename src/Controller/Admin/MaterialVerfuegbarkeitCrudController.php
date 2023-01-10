<?php

namespace App\Controller\Admin;

use App\Entity\MaterialVerfuegbarkeit;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MaterialVerfuegbarkeitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MaterialVerfuegbarkeit::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('bezeichnung')
        ];
    }

}
