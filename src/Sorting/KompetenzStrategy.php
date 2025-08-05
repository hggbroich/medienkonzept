<?php

namespace App\Sorting;

use App\Entity\Kompetenz;

/**
 * @implements SortingStrategyInterface<Kompetenz>
 */
readonly class KompetenzStrategy implements SortingStrategyInterface {

    public function __construct(private NumberStrategy $strategy) { }

    /**
     * @param Kompetenz $objectA
     * @param Kompetenz $objectB
     * @return int
     */
    public function compare($objectA, $objectB): int {
        return $this->strategy->compare($objectA->getLaufendeNummer(), $objectB->getLaufendeNummer());
    }
}