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
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
        yield MenuItem::linkToCrud('Fach', '', Fach::class);
        yield MenuItem::linkToCrud('Jahrgang', '', Jahrgang::class);
        yield MenuItem::linkToCrud('Jahrgangsstufe', '', Jahrgangsstufe::class);
        yield MenuItem::linkToCrud('Lerneinheit', '', Lerneinheit::class);
        yield MenuItem::linkToCrud('LerneinheitArt', '', LerneinheitArt::class);
        yield MenuItem::linkToCrud('LerneinheitFunktion', '', LerneinheitFunktion::class);
        yield MenuItem::linkToCrud('Material', '', Material::class);
        yield MenuItem::linkToCrud('MaterialArt', '', MaterialArt::class);
        yield MenuItem::linkToCrud('MaterialVerfuegbarkeit', '', MaterialVerfuegbarkeit::class);
        yield MenuItem::linkToCrud('Kompetenz', '', Kompetenz::class);
        yield MenuItem::linkToCrud('Kompetenzbereich', '', Kompetenzbereich::class);
        yield MenuItem::linkToCrud('Modul', '', Modul::class);
        yield MenuItem::linkToCrud('ModulInhalt', '', ModulInhalt::class);
        yield MenuItem::linkToCrud('ModulKompetenzstufe', '', ModulKompetenzstufe::class);
        yield MenuItem::linkToCrud('Werkzeug', '', Werkzeug::class);
    }
}
