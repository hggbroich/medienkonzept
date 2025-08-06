<?php

namespace App\Controller\Dashboard;

use App\Grouping\Grouper;
use App\Repository\JahrgangsstufeRepositoryInterface;
use App\Repository\KompetenzBereichRepositoryInterface;
use App\View\Overview\ModulInhaltByKompetenzOverview;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ShowKompetenzenAction extends AbstractController {

    #[Route('/kompetenzen', name: 'dashboard_kompetenzen')]
    public function __invoke(Grouper $grouper,
                             KompetenzBereichRepositoryInterface $kompetenzBereichRepository,
                             JahrgangsstufeRepositoryInterface $jahrgangsstufeRepository,
                             ModulInhaltByKompetenzOverview $overview): Response {

        return $this->render('dashboard/kompetenzen.html.twig', [
            'bereiche' => $kompetenzBereichRepository->findAll(),
            'jahrgangsstufen' => $jahrgangsstufeRepository->findAll(),
            'overview' => $overview,
        ]);
    }
}