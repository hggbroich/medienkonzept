<?php

namespace App\Repository;

use App\Entity\Kompetenz;

interface KompetenzRepositoryInterface {

    /**
     * @return Kompetenz[]
     */
    public function findAll(): array;
}