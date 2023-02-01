<?php

namespace App\View\Filter;

use App\Entity\Kompetenz;
use App\Grouping\Grouper;
use App\Grouping\KompetenzKompetenzbereichGrouping;
use App\Repository\KompetenzRepositoryInterface;
use App\Sorting\KompetenzKompetenzbereichGroupStrategy;
use App\Sorting\KompetenzStrategy;
use App\Sorting\Sorter;
use App\Utils\ArrayUtils;
use Symfony\Component\HttpFoundation\Request;

class KompetenzFilter {

    public function __construct(private readonly KompetenzRepositoryInterface $repository, private readonly Grouper $grouper, private readonly Sorter $sorter) { }

    public function handle(Request $request): KompetenzFilterView {
        $kompetenzen = ArrayUtils::createArrayWithKeys(
            $this->repository->findAll(),
            fn(Kompetenz $kompetenz) => $kompetenz->getId()
        );

        $selectedId = $request->query->getInt('kompetenz');
        $selected = nulL;

        if($selectedId > 0 && array_key_exists($selectedId, $kompetenzen)) {
            $selected = $kompetenzen[$selectedId];
        }

        $gruppen = $this->grouper->group($kompetenzen, KompetenzKompetenzbereichGrouping::class);
        $this->sorter->sort($gruppen, KompetenzKompetenzbereichGroupStrategy::class);
        $this->sorter->sortGroupItems($gruppen, KompetenzStrategy::class);

        return new KompetenzFilterView($gruppen, $selected);
    }
}