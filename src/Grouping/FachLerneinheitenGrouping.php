<?php

namespace App\Grouping;

use App\Entity\Fach;
use App\Entity\Lerneinheit;
use App\Entity\ModulInhalt;

class FachLerneinheitenGrouping implements GroupingStrategyInterface {

    /**
     * @param Lerneinheit $object
     * @param array $options
     * @return mixed|void
     */
    public function computeKey($object, array $options = []) {
        return $object->getFach();
    }

    /**
     * @param Fach $keyA
     * @param Fach $keyB
     * @param array $options
     * @return bool
     */
    public function areEqualKeys($keyA, $keyB, array $options = []): bool {
        return $keyA->getId() === $keyB->getId();
    }

    /**
     * @param Fach $key
     * @param array $options
     * @return GroupInterface
     */
    public function createGroup($key, array $options = []): GroupInterface {
        return new FachLerneinheitenGroup($key);
    }
}