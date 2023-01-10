<?php

namespace App\Repository;

use App\Entity\Fach;
use App\Entity\Jahrgangsstufe;
use App\Entity\Lerneinheit;

interface LerneinheitRepositoryInterface {

    /**
     * @param Jahrgangsstufe $jgst
     * @param Fach|null $fach
     * @return Lerneinheit[]
     */
    public function findAllByJgstAndSubject(Jahrgangsstufe $jgst, ?Fach $fach): array;
}