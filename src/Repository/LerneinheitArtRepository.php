<?php

namespace App\Repository;

use App\Entity\LerneinheitArt;

class LerneinheitArtRepository extends AbstractRepository implements LerneinheitArtRepositoryInterface {

    public function findAll(): array {
        return $this->em->getRepository(LerneinheitArt::class)
            ->findBy([], ['bezeichnung' => 'asc']);
    }
}