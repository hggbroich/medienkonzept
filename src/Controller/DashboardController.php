<?php

namespace App\Controller;

use App\Grouping\FachLerneinheitenGrouping;
use App\Grouping\Grouper;
use App\Repository\LerneinheitRepositoryInterface;
use App\Sorting\FachLerneinheitenGroupStrategy;
use App\Sorting\Sorter;
use App\View\Filter\FachFilter;
use App\View\Filter\JahrgangsstufenFilter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController {

    public function __construct(private readonly LerneinheitRepositoryInterface $repository, private readonly Grouper $grouper, private readonly Sorter $sorter) {

    }

    #[Route('')]
    #[Route('/', name: 'dashboard')]
    public function index(Request $request, JahrgangsstufenFilter $jgstFilter, FachFilter $fachFilter) {
        $jgstFilterView = $jgstFilter->handleRequest($request);
        $fachFilterView = $fachFilter->handleRequest($request);

        $module = $this->repository->findAllByJgstAndSubject($jgstFilterView->getAktuelleJahrgangsstufe(), $fachFilterView->getAktuellesFach());

        $groups = $this->grouper->group($module, FachLerneinheitenGrouping::class);
        $this->sorter->sort($groups, FachLerneinheitenGroupStrategy::class);

        return $this->render('dashboard/index.html.twig', [
            'jgstFilter' => $jgstFilterView,
            'fachFilter' => $fachFilterView,
            'groups' => $groups
        ]);
    }
}