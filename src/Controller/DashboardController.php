<?php

namespace App\Controller;

use App\Entity\Fach;
use App\Entity\Jahrgangsstufe;
use App\Entity\Lerneinheit;
use App\Entity\LerneinheitArt;
use App\Entity\LerneinheitFunktion;
use App\Grouping\FachLerneinheitenGrouping;
use App\Grouping\Grouper;
use App\Grouping\JahrgangsstufeLerneinheitenGroup;
use App\Grouping\JahrgangsstufeLerneinheitenGrouping;
use App\Repository\FachRepositoryInterface;
use App\Repository\JahrgangsstufeRepositoryInterface;
use App\Repository\LerneinheitRepositoryInterface;
use App\Sorting\FachLerneinheitenGroupStrategy;
use App\Sorting\JahrgangsstufeLerneinheitenGroupStrategy;
use App\Sorting\Sorter;
use App\View\Filter\FachFilter;
use App\View\Filter\JahrgangsstufenFilter;
use App\View\Filter\KompetenzFilter;
use App\View\Filter\LerneinheitArtFilter;
use App\View\Filter\LerneinheitFunktionFilter;
use App\View\Filter\ModulFilter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController {

    public function __construct(private readonly LerneinheitRepositoryInterface $repository, private readonly Grouper $grouper, private readonly Sorter $sorter) {

    }

    #[Route('')]
    #[Route('/', name: 'dashboard')]
    #[Route('/jahrgangsstufe', name: 'jgst_redirect')]
    public function index(JahrgangsstufeRepositoryInterface $jahrgangsstufeRepository) {
        $jgst = $jahrgangsstufeRepository->findAll();
        if(count($jgst) === 0) {
            return $this->render('dashboard/empty.html.twig');
        }

        $first = reset($jgst);
        return $this->redirectToRoute('jgst', [
            'id' => $first->getId()
        ]);
    }

    #[Route('/jahrgangsstufe/{id}', name: 'jgst')]
    public function jgst(Request $request, Jahrgangsstufe $jgst, JahrgangsstufeRepositoryInterface $jahrgangsstufeRepository,
                         FachFilter $fachFilter, KompetenzFilter $kompetenzFilter, ModulFilter $modulFilter,
                         LerneinheitFunktionFilter $funktionFilter, LerneinheitArtFilter $artFilter) {
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

    #[Route('/fach', name: 'fach_redirect')]
    public function redirectToFach(FachRepositoryInterface $fachRepository) {
        $faecher = $fachRepository->findAll();
        if(count($faecher) === 0) {
            return $this->render('dashboard/empty.html.twig');
        }

        $first = reset($faecher);
        return $this->redirectToRoute('fach', [
            'id' => $first->getId()
        ]);
    }

    #[Route('/fach/{id}', 'fach')]
    public function fach(Request $request, Fach $fach, FachRepositoryInterface $fachRepository,
                         JahrgangsstufenFilter $jgstFilter, KompetenzFilter $kompetenzFilter, ModulFilter $modulFilter,
                         LerneinheitFunktionFilter $funktionFilter, LerneinheitArtFilter $artFilter) {
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

    /**
     * @param Lerneinheit[] $lerneinheiten
     * @param LerneinheitFunktion|null $funktion
     * @return Lerneinheit[]
     */
    private function filterFunktion(array $lerneinheiten, ?LerneinheitFunktion $funktion): array {
        return array_filter(
            $lerneinheiten,
            fn(Lerneinheit $lerneinheit) => $funktion === null || $funktion->getId() === $lerneinheit->getFunktion()->getId()
        );
    }

    /**
     * @param Lerneinheit[] $lerneinheiten
     * @param LerneinheitArt|null $art
     * @return Lerneinheit[]
     */
    private function filterArt(array $lerneinheiten, ?LerneinheitArt $art): array {
        return array_filter(
            $lerneinheiten,
            fn(Lerneinheit $lerneinheit) => $art === null || $art->getId() === $lerneinheit->getArt()->getId()
        );
    }
}