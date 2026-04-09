<?php

namespace App\Controller\Admin;

use App\Entity\Fach;
use App\Entity\Jahrgang;
use App\Entity\Jahrgangsstufe;
use App\Entity\Kompetenz;
use App\Entity\Kompetenzbereich;
use App\Entity\Lerneinheit;
use App\Entity\LerneinheitArt;
use App\Entity\LerneinheitFunktion;
use App\Entity\Material;
use App\Entity\MaterialArt;
use App\Entity\MaterialVerfuegbarkeit;
use App\Entity\Modul;
use App\Entity\ModulInhalt;
use App\Entity\ModulKompetenzstufe;
use App\Entity\Werkzeug;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[AdminDashboard(routePath: '/admin/ea', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    #[Route('/admin/ea', name: 'admin')]
    public function index(): Response {
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Curriculum');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Stammdaten');
        yield MenuItem::linkTo(FachCrudController::class, 'Fach', '');
        yield MenuItem::linkTo(JahrgangCrudController::class, 'Jahrgang', '');
        yield MenuItem::linkTo(JahrgangsstufeCrudController::class, 'Jahrgangsstufe', '');
        yield MenuItem::section('Lerneinheit');
        yield MenuItem::linkTo(LerneinheitCrudController::class, 'Lerneinheit', '')->setCssClass('fw-bold');
        yield MenuItem::linkTo(LerneinheitArtCrudController::class, 'LerneinheitArt', '');
        yield MenuItem::linkTo(LerneinheitFunktionCrudController::class, 'LerneinheitFunktion', '');
        yield MenuItem::section('Material');
        yield MenuItem::linkTo(MaterialCrudController::class, 'Material', '');
        yield MenuItem::linkTo(MaterialArtCrudController::class, 'MaterialArt', '');
        yield MenuItem::linkTo(MaterialVerfuegbarkeitCrudController::class, 'MaterialVerfuegbarkeit', '');
        yield MenuItem::section('Kompetenzen');
        yield MenuItem::linkTo(KompetenzCrudController::class, 'Kompetenz', '');
        yield MenuItem::linkTo(KompetenzbereichCrudController::class, 'Kompetenzbereich', '');
        yield MenuItem::section('Modul');
        yield MenuItem::linkTo(ModulCrudController::class, 'Modul', '');
        yield MenuItem::linkTo(ModulInhaltCrudController::class, 'ModulInhalt', '')->setCssClass('fw-bold');
        yield MenuItem::linkTo(ModulKompetenzstufeCrudController::class, 'ModulKompetenzstufe', '');
        yield MenuItem::section('Werkzeug');
        yield MenuItem::linkTo(WerkzeugCrudController::class, 'Werkzeug', '');
    }
}
