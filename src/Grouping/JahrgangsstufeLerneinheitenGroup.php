<?php

namespace App\Grouping;

use App\Entity\Jahrgangsstufe;
use App\Entity\Lerneinheit;

class JahrgangsstufeLerneinheitenGroup implements GroupInterface {

    /** @var Lerneinheit[] */
    private array $lerneinheiten = [ ];

    public function __construct(private readonly Jahrgangsstufe $jahrgangsstufe) { }

    /**
     * @return Jahrgangsstufe
     */
    public function getJahrgangsstufe(): Jahrgangsstufe {
        return $this->jahrgangsstufe;
    }

    /**
     * @return Lerneinheit[]
     */
    public function getLerneinheiten(): array {
        return $this->lerneinheiten;
    }

    public function getKey() {
        return $this->jahrgangsstufe;
    }

    public function addItem($item) {
        $this->lerneinheiten[] = $item;
    }
}