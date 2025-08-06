<?php

namespace App\View\Overview;

use App\Entity\Jahrgangsstufe;
use App\Entity\Kompetenz;
use App\Entity\ModulInhalt;
use App\Repository\ModulInhaltRepositoryInterface;
use App\Sorting\Sorter;
use App\Utils\ArrayUtils;

readonly class ModulInhaltByKompetenzOverview {

    public function __construct(private ModulInhaltRepositoryInterface $modulInhaltRepository, private Sorter $sorter) {

    }

    /**
     * @param Jahrgangsstufe $jgst
     * @param Kompetenz $kompetenz
     * @return Row[]
     */
    public function getModulInhalte(Jahrgangsstufe $jgst, Kompetenz $kompetenz): array {
        $inhalte = $this->modulInhaltRepository->findBy($jgst, $kompetenz);

        $faecherMap = [ ];
        $inhalteByFachMap = [ ];

        foreach($inhalte as $inhalt) {
            foreach($inhalt->getLerneinheiten() as $lerneinheit) {
                if(!array_key_exists($lerneinheit->getFach()->getId(), $faecherMap)) {
                    $faecherMap[$lerneinheit->getFach()->getId()] = $lerneinheit->getFach();
                }

                if(!array_key_exists($lerneinheit->getFach()->getId(), $inhalteByFachMap)) {
                    $inhalteByFachMap[$lerneinheit->getFach()->getId()] = [ ];
                }

                $inhalteByFachMap[$lerneinheit->getFach()->getId()][] = $inhalt;
            }
        }

        $rows = [ ];

        foreach($faecherMap as $id => $fach) {
            $rows[] = new Row($fach, ArrayUtils::unique($inhalteByFachMap[$id]));
        }

        $this->sorter->sort($rows, RowSortingStrategy::class);

        return $rows;
    }
}