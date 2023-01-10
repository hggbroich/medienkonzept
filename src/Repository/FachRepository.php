<?php

namespace App\Repository;

use App\Entity\Fach;

class FachRepository extends AbstractRepository implements FachRepositoryInterface {

    public function findAll(): array {
        return $this->em->getRepository(Fach::class)
            ->findBy([], [
                'bezeichnung' => 'asc'
            ]);
    }
}