<?php

namespace App\Repository;

use App\Entity\Fach;
use App\Entity\Jahrgangsstufe;
use App\Entity\Kompetenz;
use App\Entity\Lerneinheit;
use App\Entity\Modul;

interface LerneinheitRepositoryInterface {

    /**
     * @param Jahrgangsstufe|null $jgst
     * @param Fach|null $fach
     * @param Kompetenz|null $kompetenz
     * @param Modul|null $modul
     * @return array
     */
    public function findAllByJgstAndSubject(?Jahrgangsstufe $jgst, ?Fach $fach, ?Kompetenz $kompetenz = null, ?Modul $modul = null): array;
}