<?php

namespace App\Grouping;

use App\Entity\Kompetenz;
use App\Entity\Kompetenzbereich;

/**
 * @implements GroupInterface<Kompetenzbereich, Kompetenz>
 * @implements SortableGroupInterface<Kompetenz>
 */
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
     * @return Kompetenz[]
     */
    public function getKompetenzen(): array {
        return $this->kompetenzen;
    }

    public function getKey(): mixed {
        return $this->kompetenzbereich;
    }

    public function addItem($item): void {
        $this->kompetenzen[] = $item;
    }

    public function &getItems(): array {
        return $this->kompetenzen;
    }
}