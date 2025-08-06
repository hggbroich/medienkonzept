<?php

namespace App\Repository;

use App\Entity\Jahrgangsstufe;
use App\Entity\Kompetenz;
use App\Entity\ModulInhalt;

interface ModulInhaltRepositoryInterface {

    /**
     * @return ModulInhalt[]
     */
    public function findAll(): array;

    /**
     * @param Jahrgangsstufe $jahrgangsstufe
     * @param Kompetenz $kompetenz
     * @return ModulInhalt[]
     */
    public function findBy(Jahrgangsstufe $jahrgangsstufe, Kompetenz $kompetenz): array;
}