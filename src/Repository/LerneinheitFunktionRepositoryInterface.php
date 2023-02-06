<?php

namespace App\Repository;

use App\Entity\LerneinheitFunktion;

interface LerneinheitFunktionRepositoryInterface {

    /**
     * @return LerneinheitFunktion[]
     */
    public function findAll(): array;
}