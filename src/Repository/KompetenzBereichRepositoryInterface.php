<?php

namespace App\Repository;

use App\Entity\Kompetenzbereich;

interface KompetenzBereichRepositoryInterface {

    /**
     * @return Kompetenzbereich[]
     */
    public function findAll(): array;
}