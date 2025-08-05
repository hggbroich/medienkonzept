<?php

namespace App\Sorting;

use App\Grouping\KompetenzKompetenzbereichGroup;

/**
 * @implements SortingStrategyInterface<KompetenzKompetenzbereichGroup>
 */
readonly class KompetenzKompetenzbereichGroupStrategy implements SortingStrategyInterface {

    public function __construct(private NumberStrategy $strategy) { }

    /**
     * @param KompetenzKompetenzbereichGroup $objectA
     * @param KompetenzKompetenzbereichGroup $objectB
     * @return int
     */
    public function compare($objectA, $objectB): int {
        return $this->strategy->compare($objectA->getKompetenzbereich()->getLaufendeNummer(), $objectB->getKompetenzbereich()->getLaufendeNummer());
    }
}