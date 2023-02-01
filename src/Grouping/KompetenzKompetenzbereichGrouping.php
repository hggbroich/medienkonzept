<?php

namespace App\Grouping;

use App\Entity\Kompetenz;
use App\Entity\Kompetenzbereich;

class KompetenzKompetenzbereichGrouping implements GroupingStrategyInterface {

    /**
     * @param Kompetenz $object
     * @param array $options
     * @return Kompetenzbereich
     */
    public function computeKey($object, array $options = []) {
        return $object->getKompetenzbereich();
    }

    /**
     * @param Kompetenzbereich $keyA
     * @param Kompetenzbereich $keyB
     * @param array $options
     * @return bool
     */
    public function areEqualKeys($keyA, $keyB, array $options = []): bool {
        return $keyA->getId() === $keyB->getId();
    }

    /**
     * @param Kompetenzbereich $key
     * @param array $options
     * @return GroupInterface
     */
    public function createGroup($key, array $options = []): GroupInterface {
        return new KompetenzKompetenzbereichGroup($key);
    }
}