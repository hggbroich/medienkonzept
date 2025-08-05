<?php

namespace App\Sorting;

/**
 * @implements SortingStrategyInterface<int|float>
 */
class NumberStrategy implements SortingStrategyInterface {

    /**
     * @param int|float $objectA
     * @param int|float $objectB
     * @return int
     */
    public function compare($objectA, $objectB): int {
        if($objectA === $objectB) {
            return 0;
        }

        return $objectA - $objectB < 0 ? -1 : 1;
    }
}