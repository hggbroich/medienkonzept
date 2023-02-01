<?php

namespace App\View\Filter;

use App\Entity\Kompetenz;
use App\Grouping\KompetenzKompetenzbereichGroup;

class KompetenzFilterView {

    /**
     * @param KompetenzKompetenzbereichGroup[] $kompetenzen
     * @param Kompetenz|null $aktuelleKompetenz
     */
    public function __construct(private readonly array $kompetenzen, private readonly ?Kompetenz $aktuelleKompetenz) {
    }

    /**
     * @return KompetenzKompetenzbereichGroup[]
     */
    public function getKompetenzen(): array {
        return $this->kompetenzen;
    }

    /**
     * @return Kompetenz|null
     */
    public function getAktuelleKompetenz(): ?Kompetenz {
        return $this->aktuelleKompetenz;
    }
}