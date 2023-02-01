<?php

namespace App\Sorting;

use App\Grouping\KompetenzKompetenzbereichGroup;

class KompetenzKompetenzbereichGroupStrategy implements SortingStrategyInterface {

    public function __construct(private readonly NumberStrategy $strategy) { }

    /**
     * @param KompetenzKompetenzbereichGroup $objectA
     * @param KompetenzKompetenzbereichGroup $objectB
     * @return int
     */
    public function compare($objectA, $objectB): int {
        return $this->strategy->compare($objectA->getKompetenzbereich()->getLaufendeNummer(), $objectB->getKompetenzbereich()->getLaufendeNummer());
    }
}