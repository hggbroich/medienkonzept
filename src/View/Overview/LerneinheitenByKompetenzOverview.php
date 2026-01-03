<?php

namespace App\View\Overview;

use App\Entity\Kompetenz;
use App\Entity\Lerneinheit;
use App\Repository\JahrgangsstufeRepositoryInterface;
use App\Repository\LerneinheitRepositoryInterface;

readonly class LerneinheitenByKompetenzOverview {

    public function __construct(
        private JahrgangsstufeRepositoryInterface $jahrgangsstufeRepository,
        private LerneinheitRepositoryInterface $lerneinheitRepository
    ) {

    }

    /**
     * @param array $jahrgaenge
     * @param Kompetenz $kompetenz
     * @return Lerneinheit[]
     */
    public function getModulInhalte(array $jahrgaenge, Kompetenz $kompetenz): array {
        $lerneinheiten = [ ];
        foreach($this->jahrgangsstufeRepository->findAllByJahrgaenge($jahrgaenge) as $jgst) {
            $lerneinheiten = array_merge(
                $lerneinheiten,
                $this->lerneinheitRepository->findAllByJgstAndSubject($jgst, null, $kompetenz)
            );
        }

        return $lerneinheiten;
    }
}