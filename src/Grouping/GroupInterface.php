<?php

namespace App\Grouping;

/**
 * @template K
 * @template V
 */
interface GroupInterface {

    /**
     * @return K
     */
    public function getKey(): mixed;

    /**
     * @param V $item
     * @return void
     */
    public function addItem($item): void;
}