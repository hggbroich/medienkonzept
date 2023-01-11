<?php

namespace App\Grouping;

use App\Entity\Lerneinheit;

class JahrgangsstufeLerneinheitenGrouping implements GroupingStrategyInterface {

    /**
     * @param Lerneinheit $object
     * @param array $options
     * @return mixed|void
     */
    public function computeKey($object, array $options = []) {
        return $object->getJahrgangsstufen()->toArray();
    }

    /**
     * @param Lerneinheit $keyA
     * @param Lerneinheit $keyB
     * @param array $options
     * @return bool
     */
    public function areEqualKeys($keyA, $keyB, array $options = []): bool {
        return $keyA->getId() === $keyB->getId();
    }

    /**
     * @param Lerneinheit $key
     * @param array $options
     * @return GroupInterface
     */
    public function createGroup($key, array $options = []): GroupInterface {
        return new JahrgangsstufeLerneinheitenGroup($key);
    }
}