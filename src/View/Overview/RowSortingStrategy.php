<?php

namespace App\View\Overview;

use App\Sorting\SortingStrategyInterface;
use App\Sorting\StringStrategy;

/**
 * @implements SortingStrategyInterface<Row>
 */
readonly class RowSortingStrategy implements SortingStrategyInterface {

    public function __construct(private StringStrategy $strategy) {

    }

    public function compare($objectA, $objectB): int {
        return $this->strategy->compare($objectA->fach->getKuerzel(), $objectB->fach->getKuerzel());
    }
}