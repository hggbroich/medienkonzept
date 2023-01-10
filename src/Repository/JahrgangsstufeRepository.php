<?php

namespace App\Repository;

use App\Entity\Jahrgangsstufe;

class JahrgangsstufeRepository extends AbstractRepository implements JahrgangsstufeRepositoryInterface {

    public function findAll(): array {
        return $this->em->getRepository(Jahrgangsstufe::class)
            ->findBy([], [
                'bezeichnung' => 'asc'
            ]);
    }
}