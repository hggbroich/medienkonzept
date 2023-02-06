<?php

namespace App\Repository;

use App\Entity\LerneinheitFunktion;

class LerneinheitFunktionRepository extends AbstractRepository implements LerneinheitFunktionRepositoryInterface {

    public function findAll(): array {
        return $this->em->getRepository(LerneinheitFunktion::class)
            ->findBy([], ['bezeichnung' => 'asc']);
    }
}