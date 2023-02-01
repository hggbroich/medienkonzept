<?php

namespace App\Repository;

use App\Entity\Modul;

class ModulRepository extends AbstractRepository implements ModulRepositoryInterface {

    public function findAll(): array {
        return $this->em->getRepository(Modul::class)
            ->findBy([], ['bezeichnung' => 'asc']);
    }
}