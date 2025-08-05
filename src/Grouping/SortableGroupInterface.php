<?php

namespace App\Grouping;

/**
 * @template T
 */
interface SortableGroupInterface {

    /**
     * @return T[]
     */
    public function &getItems(): array;
}