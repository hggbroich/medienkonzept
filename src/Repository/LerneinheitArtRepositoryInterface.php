<?php

namespace App\Repository;

use App\Entity\LerneinheitArt;

interface LerneinheitArtRepositoryInterface {

    /**
     * @return LerneinheitArt[]
     */
    public function findAll(): array;
}