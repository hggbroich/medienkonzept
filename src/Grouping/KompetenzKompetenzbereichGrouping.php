<?php

namespace App\Grouping;

use App\Entity\Kompetenz;
use App\Entity\Kompetenzbereich;

/**
 * @implements GroupingStrategyInterface<Kompetenzbereich, Kompetenz, KompetenzKompetenzbereichGroup>
 */
class KompetenzKompetenzbereichGrouping implements GroupingStrategyInterface {

    public function computeKey($object, array $options = []): mixed {
        return $object->getKompetenzbereich();
    }

    public function areEqualKeys($keyA, $keyB, array $options = []): bool {
        return $keyA->getId() === $keyB->getId();
    }

    public function createGroup($key, array $options = []): GroupInterface {
        return new KompetenzKompetenzbereichGroup($key);
    }
}