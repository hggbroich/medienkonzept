<?php

namespace App\Sorting;

use App\Entity\Fach;

class FachStrategy implements SortingStrategyInterface {

    public function __construct(private readonly StringStrategy $strategy) {}

    /**
     * @param Fach $objectA
     * @param Fach $objectB
     * @return int
     */
    public function compare($objectA, $objectB): int {
        return $this->strategy->compare($objectA->getBezeichnung(), $objectB->getBezeichnung());
    }
}