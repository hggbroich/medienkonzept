<?php

namespace App\Sorting;

use App\Entity\Kompetenz;

class KompetenzStrategy implements SortingStrategyInterface {

    public function __construct(private readonly NumberStrategy $strategy) { }

    /**
     * @param Kompetenz $objectA
     * @param Kompetenz $objectB
     * @return int
     */
    public function compare($objectA, $objectB): int {
        return $this->strategy->compare($objectA->getLaufendeNummer(), $objectB->getLaufendeNummer());
    }
}