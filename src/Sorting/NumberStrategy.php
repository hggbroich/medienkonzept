<?php

namespace App\Sorting;

class NumberStrategy implements SortingStrategyInterface {

    /**
     * @param int|float|double $objectA
     * @param int|float|double $objectB
     * @return int
     */
    public function compare($objectA, $objectB): int {
        if($objectA === $objectB) {
            return 0;
        }

        return $objectA - $objectB < 0 ? -1 : 1;
    }
}