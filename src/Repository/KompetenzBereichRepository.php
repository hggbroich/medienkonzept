<?php

namespace App\Repository;

use App\Entity\Kompetenzbereich;

class KompetenzBereichRepository extends AbstractRepository implements KompetenzBereichRepositoryInterface {

    public function findAll(): array {
        return $this->em->getRepository(Kompetenzbereich::class)->findBy([], ['laufendeNummer' => 'asc']);
    }
}