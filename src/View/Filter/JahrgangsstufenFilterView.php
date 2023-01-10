<?php

namespace App\View\Filter;

use App\Entity\Jahrgangsstufe;

class JahrgangsstufenFilterView {
    /**
     * @param Jahrgangsstufe[] $jahrgangsstufen
     * @param Jahrgangsstufe|null $aktuelleJahrgangsstufe
     */
    public function __construct(private readonly array $jahrgangsstufen, private readonly ?Jahrgangsstufe $aktuelleJahrgangsstufe) {

    }

    /**
     * @return Jahrgangsstufe|null
     */
    public function getAktuelleJahrgangsstufe(): ?Jahrgangsstufe {
        return $this->aktuelleJahrgangsstufe;
    }

    /**
     * @return Jahrgangsstufe[]
     */
    public function getJahrgangsstufen(): array {
        return $this->jahrgangsstufen;
    }
}