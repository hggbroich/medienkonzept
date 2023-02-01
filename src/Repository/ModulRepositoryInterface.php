<?php

namespace App\Repository;

use App\Entity\Modul;

interface ModulRepositoryInterface {

    /**
     * @return Modul[]
     */
    public function findAll(): array;
}