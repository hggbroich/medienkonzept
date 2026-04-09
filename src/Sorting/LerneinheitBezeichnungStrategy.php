<?php

namespace App\Sorting;

use App\Entity\Lerneinheit;
use Override;

class LerneinheitBezeichnungStrategy implements SortingStrategyInterface {

    /**
     * @param Lerneinheit $objectA
     * @param Lerneinheit $objectB
     * @return int
     */
    #[Override]
    public function compare($objectA, $objectB): int {
        return strnatcmp($objectA->getBezeichnung(), $objectB->getBezeichnung());
    }
}