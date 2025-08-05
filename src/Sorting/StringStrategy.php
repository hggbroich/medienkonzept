<?php

namespace App\Sorting;

/**
 * @implements SortingStrategyInterface<string>
 */
class StringStrategy implements SortingStrategyInterface {

    public function compare($objectA, $objectB): int {
        return strnatcasecmp((string)$objectA, (string)$objectB);
    }
}