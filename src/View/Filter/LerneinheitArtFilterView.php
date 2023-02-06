<?php

namespace App\View\Filter;

use App\Entity\LerneinheitArt;

class LerneinheitArtFilterView {

    /**
     * @param LerneinheitArt[] $arten
     * @param LerneinheitArt|null $aktuelleArt
     */
    public function __construct(private readonly array $arten, private readonly ?LerneinheitArt $aktuelleArt) { }

    /**
     * @return LerneinheitArt|null
     */
    public function getAktuelleArt(): ?LerneinheitArt {
        return $this->aktuelleArt;
    }

    /**
     * @return LerneinheitArt[]
     */
    public function getArten(): array {
        return $this->arten;
    }
}