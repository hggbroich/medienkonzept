<?php

namespace App\Controller\Dashboard;

use App\Entity\Lerneinheit;
use App\Entity\LerneinheitArt;
use App\Entity\LerneinheitFunktion;

trait FilterTrait {
    /**
     * @param Lerneinheit[] $lerneinheiten
     * @param LerneinheitArt|null $art
     * @return Lerneinheit[]
     */
    private function filterArt(array $lerneinheiten, ?LerneinheitArt $art): array {
        return array_filter(
            $lerneinheiten,
            fn(Lerneinheit $lerneinheit) => $art === null || $art->getId() === $lerneinheit->getArt()->getId()
        );
    }

    /**
     * @param Lerneinheit[] $lerneinheiten
     * @param LerneinheitFunktion|null $funktion
     * @return Lerneinheit[]
     */
    private function filterFunktion(array $lerneinheiten, ?LerneinheitFunktion $funktion): array {
        return array_filter(
            $lerneinheiten,
            fn(Lerneinheit $lerneinheit) => $funktion === null || $funktion->getId() === $lerneinheit->getFunktion()->getId()
        );
    }
}