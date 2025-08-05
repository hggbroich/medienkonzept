<?php

namespace App\Sorting;

use App\Entity\Fach;

/**
 * @implements SortingStrategyInterface<Fach>
 */
readonly class FachStrategy implements SortingStrategyInterface {

    public function __construct(private StringStrategy $strategy) {}

    /**
     * @param Fach $objectA
     * @param Fach $objectB
     * @return int
     */
    public function compare($objectA, $objectB): int {
        return $this->strategy->compare($objectA->getBezeichnung(), $objectB->getBezeichnung());
    }
}