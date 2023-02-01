<?php

namespace App\View\Filter;

use App\Entity\Modul;

class ModulFilterView {

    /**
     * @param Modul[] $module
     * @param Modul|null $aktuellesModul
     */
    public function __construct(private readonly array $module, private readonly ?Modul $aktuellesModul) { }

    /**
     * @return Modul|null
     */
    public function getAktuellesModul(): ?Modul {
        return $this->aktuellesModul;
    }

    /**
     * @return Modul[]
     */
    public function getModule(): array {
        return $this->module;
    }
}