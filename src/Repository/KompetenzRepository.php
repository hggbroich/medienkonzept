<?php

namespace App\Repository;

use App\Entity\Kompetenz;

class KompetenzRepository extends AbstractRepository implements KompetenzRepositoryInterface {

    public function findAll(): array {
        return $this->em->getRepository(Kompetenz::class)
            ->findAll();
    }
}