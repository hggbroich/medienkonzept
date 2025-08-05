<?php

namespace App\Grouping;

use App\Entity\Jahrgangsstufe;
use App\Entity\Lerneinheit;

/**
 * @implements GroupingStrategyInterface<Jahrgangsstufe, Lerneinheit, JahrgangsstufeLerneinheitenGroup>
 */
class JahrgangsstufeLerneinheitenGrouping implements GroupingStrategyInterface {

    public function computeKey($object, array $options = []): mixed {
        return $object->getJahrgangsstufen()->toArray();
    }

    public function areEqualKeys($keyA, $keyB, array $options = []): bool {
        return $keyA->getId() === $keyB->getId();
    }

    public function createGroup($key, array $options = []): GroupInterface {
        return new JahrgangsstufeLerneinheitenGroup($key);
    }
}