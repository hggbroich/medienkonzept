<?php

namespace App\Controller\Dashboard;

use App\Entity\Jahrgangsstufe;
use App\Grouping\FachLerneinheitenGrouping;
use App\Grouping\Grouper;
use App\Repository\JahrgangsstufeRepositoryInterface;
use App\Repository\LerneinheitRepositoryInterface;
use App\Sorting\FachLerneinheitenGroupStrategy;
use App\Sorting\Sorter;
use App\View\Filter\FachFilter;
use App\View\Filter\KompetenzFilter;
use App\View\Filter\LerneinheitArtFilter;
use App\View\Filter\LerneinheitFunktionFilter;
use App\View\Filter\ModulFilter;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowJahrgangsstufeAction extends AbstractController {
    use FilterTrait;

    public function __construct(private readonly LerneinheitRepositoryInterface $repository,
                                private readonly Grouper $grouper,
                                private readonly Sorter $sorter) {

    }

    #[Route('/jahrgangsstufe/{id}', name: 'jgst')]
    public function __invoke(Request $request, #[MapEntity] Jahrgangsstufe $jgst, JahrgangsstufeRepositoryInterface $jahrgangsstufeRepository,
                         FachFilter $fachFilter, KompetenzFilter $kompetenzFilter, ModulFilter $modulFilter,
                         LerneinheitFunktionFilter $funktionFilter, LerneinheitArtFilter $artFilter): Response {
        $fachFilterView = $fachFilter->handleRequest($request);
        $kompetenzFilterView = $kompetenzFilter->handle($request);
        $modulFilterView = $modulFilter->handle($request);
        $funktionFilterView = $funktionFilter->handleRequest($request);
        $artFilterView = $artFilter->handleRequest($request);

        $module = $this->repository->findAllByJgstAndSubject($jgst, $fachFilterView->getAktuellesFach(), $kompetenzFilterView->getAktuelleKompetenz(), $modulFilterView->getAktuellesModul());
        $module = $this->filterFunktion($module, $funktionFilterView->getAktuelleFunktion());
        $module = $this->filterArt($module, $artFilterView->getAktuelleArt());

        $groups = $this->grouper->group($module, FachLerneinheitenGrouping::class);
        $this->sorter->sort($groups, FachLerneinheitenGroupStrategy::class);

        return $this->render('dashboard/jahrgangsstufe.html.twig', [
            'jahrgangsstufe' => $jgst,
            'jahrgangsstufen' => $jahrgangsstufeRepository->findAll(),
            'fachFilter' => $fachFilterView,
            'kompetenzFilter' => $kompetenzFilterView,
            'modulFilter' => $modulFilterView,
            'funktionFilter' => $funktionFilterView,
            'artFilter' => $artFilterView,
            'groups' => $groups
        ]);
    }


}