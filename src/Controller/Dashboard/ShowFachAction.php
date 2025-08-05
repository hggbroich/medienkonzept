<?php

namespace App\Controller\Dashboard;

use App\Entity\Fach;
use App\Grouping\Grouper;
use App\Grouping\JahrgangsstufeLerneinheitenGroup;
use App\Grouping\JahrgangsstufeLerneinheitenGrouping;
use App\Repository\FachRepositoryInterface;
use App\Repository\LerneinheitRepositoryInterface;
use App\Sorting\JahrgangsstufeLerneinheitenGroupStrategy;
use App\Sorting\Sorter;
use App\View\Filter\JahrgangsstufenFilter;
use App\View\Filter\KompetenzFilter;
use App\View\Filter\LerneinheitArtFilter;
use App\View\Filter\LerneinheitFunktionFilter;
use App\View\Filter\ModulFilter;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowFachAction extends AbstractController {
    use FilterTrait;

    public function __construct(private readonly LerneinheitRepositoryInterface $repository,
                                private readonly Grouper $grouper,
                                private readonly Sorter $sorter) {

    }

    #[Route('/fach/{id}', name: 'fach')]
    public function __invoke(Request $request, #[MapEntity] Fach $fach, FachRepositoryInterface $fachRepository,
                         JahrgangsstufenFilter $jgstFilter, KompetenzFilter $kompetenzFilter, ModulFilter $modulFilter,
                         LerneinheitFunktionFilter $funktionFilter, LerneinheitArtFilter $artFilter): Response {
        $jgstFilterView = $jgstFilter->handleRequest($request);
        $kompetenzFilterView = $kompetenzFilter->handle($request);
        $modulFilterView = $modulFilter->handle($request);
        $funktionFilterView = $funktionFilter->handleRequest($request);
        $artFilterView = $artFilter->handleRequest($request);

        $module = $this->repository->findAllByJgstAndSubject($jgstFilterView->getAktuelleJahrgangsstufe(), $fach, $kompetenzFilterView->getAktuelleKompetenz(), $modulFilterView->getAktuellesModul());
        $module = $this->filterFunktion($module, $funktionFilterView->getAktuelleFunktion());
        $module = $this->filterArt($module, $artFilterView->getAktuelleArt());

        $groups = $this->grouper->group($module, JahrgangsstufeLerneinheitenGrouping::class);
        $this->sorter->sort($groups, JahrgangsstufeLerneinheitenGroupStrategy::class);

        if($jgstFilterView->getAktuelleJahrgangsstufe() !== null) {
            $groups = array_filter($groups, fn(JahrgangsstufeLerneinheitenGroup $group) => $group->getJahrgangsstufe()->getId() === $jgstFilterView->getAktuelleJahrgangsstufe()->getId());
        }

        return $this->render('dashboard/fach.html.twig', [
            'fach' => $fach,
            'faecher' => $fachRepository->findAll(),
            'jgstFilter' => $jgstFilterView,
            'kompetenzFilter' => $kompetenzFilterView,
            'modulFilter' => $modulFilterView,
            'funktionFilter' => $funktionFilterView,
            'artFilter' => $artFilterView,
            'groups' => $groups
        ]);
    }
}