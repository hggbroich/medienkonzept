<?php

namespace App\View\Filter;

use App\Entity\LerneinheitFunktion;

class LerneinheitFunktionFilterView {

    /**
     * @param LerneinheitFunktion[] $funktionen
     * @param LerneinheitFunktion|null $aktuelleFunktion
     */
    public function __construct(private readonly array $funktionen, private readonly ?LerneinheitFunktion $aktuelleFunktion) { }

    /**
     * @return LerneinheitFunktion|null
     */
    public function getAktuelleFunktion(): ?LerneinheitFunktion {
        return $this->aktuelleFunktion;
    }

    /**
     * @return LerneinheitFunktion[]
     */
    public function getFunktionen(): array {
        return $this->funktionen;
    }
}
