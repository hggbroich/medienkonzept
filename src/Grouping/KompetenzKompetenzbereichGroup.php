<?php

namespace App\Grouping;

use App\Entity\Kompetenz;
use App\Entity\Kompetenzbereich;

class KompetenzKompetenzbereichGroup implements GroupInterface, SortableGroupInterface {

    /** @var Kompetenz[] */
    private array $kompetenzen = [ ];

    public function __construct(private readonly Kompetenzbereich $kompetenzbereich) {

    }

    /**
     * @return Kompetenzbereich
     */
    public function getKompetenzbereich(): Kompetenzbereich {
        return $this->kompetenzbereich;
    }

    /**
     * @return array
     */
    public function getKompetenzen(): array {
        return $this->kompetenzen;
    }

    public function getKey() {
        return $this->kompetenzbereich;
    }

    public function addItem($item) {
        $this->kompetenzen[] = $item;
    }

    public function &getItems(): array {
        return $this->kompetenzen;
    }
}