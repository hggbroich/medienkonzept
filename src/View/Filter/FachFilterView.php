<?php

namespace App\View\Filter;

use App\Entity\Fach;

class FachFilterView {

    /**
     * @param Fach[] $faecher
     * @param Fach|null $aktuellesFach
     */
    public function __construct(private readonly array $faecher, private readonly ?Fach $aktuellesFach) {

    }

    /**
     * @return Fach|null
     */
    public function getAktuellesFach(): ?Fach {
        return $this->aktuellesFach;
    }

    /**
     * @return Fach[]
     */
    public function getFaecher(): array {
        return $this->faecher;
    }
}