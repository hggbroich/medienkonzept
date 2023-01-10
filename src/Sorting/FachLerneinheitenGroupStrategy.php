<?php

namespace App\Sorting;

use App\Grouping\FachLerneinheitenGroup;

class FachLerneinheitenGroupStrategy implements SortingStrategyInterface {

    public function __construct(private readonly FachStrategy $fachStrategy) { }

    /**
     * @param FachLerneinheitenGroup $objectA
     * @param FachLerneinheitenGroup $objectB
     * @return int
     */
    public function compare($objectA, $objectB): int {
        return $this->fachStrategy->compare($objectA->getFach(), $objectB->getFach());
    }
}