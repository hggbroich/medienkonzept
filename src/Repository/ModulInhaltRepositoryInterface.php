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
     * @param Jahrgangsstufe[] $jahrgangsstufen
     * @param Kompetenz $kompetenz
     * @return ModulInhalt[]
     */
    public function findBy(array $jahrgangsstufen, Kompetenz $kompetenz): array;
}