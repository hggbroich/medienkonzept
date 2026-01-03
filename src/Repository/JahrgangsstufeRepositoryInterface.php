<?php

namespace App\Repository;

use App\Entity\Jahrgangsstufe;

interface JahrgangsstufeRepositoryInterface {

    /**
     * @return Jahrgangsstufe[]
     */
    public function findAll(): array;

    /**
     * @param string $bezeichnung
     * @return Jahrgangsstufe[]
     */
    public function findAllByJahrgaenge(array $bezeichnung): array;

}