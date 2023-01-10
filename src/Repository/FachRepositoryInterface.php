<?php

namespace App\Repository;

use App\Entity\Fach;

interface FachRepositoryInterface {

    /**
     * @return Fach[]
     */
    public function findAll(): array;
}