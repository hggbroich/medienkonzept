<?php

namespace App\Sorting;

use App\Grouping\JahrgangsstufeLerneinheitenGroup;

class JahrgangsstufeLerneinheitenGroupStrategy implements SortingStrategyInterface {

    public function __construct(private readonly StringStrategy $stringStrategy) { }

    /**
     * @param JahrgangsstufeLerneinheitenGroup $objectA
     * @param JahrgangsstufeLerneinheitenGroup $objectB
     * @return int
     */
    public function compare($objectA, $objectB): int {
        return $this->stringStrategy->compare($objectA->getJahrgangsstufe()->getBezeichnung(), $objectB->getJahrgangsstufe()->getBezeichnung());
    }
}