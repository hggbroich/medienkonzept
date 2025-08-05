<?php

namespace App\Grouping;

use App\Entity\Fach;
use App\Entity\Lerneinheit;
use App\Entity\ModulInhalt;

/**
 * @implements GroupingStrategyInterface<Fach, Lerneinheit, FachLerneinheitenGroup>
 */
class FachLerneinheitenGrouping implements GroupingStrategyInterface {

    public function computeKey($object, array $options = []): mixed {
        return $object->getFach();
    }

    public function areEqualKeys($keyA, $keyB, array $options = []): bool {
        return $keyA->getId() === $keyB->getId();
    }

    public function createGroup($key, array $options = []): GroupInterface {
        return new FachLerneinheitenGroup($key);
    }
}