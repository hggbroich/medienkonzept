<?php

namespace App\Grouping;

use App\Entity\Jahrgangsstufe;
use App\Entity\Lerneinheit;

/**
 * @implements GroupInterface<Jahrgangsstufe, Lerneinheit>
 */
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

    public function getKey(): mixed {
        return $this->jahrgangsstufe;
    }

    public function addItem($item): void {
        $this->lerneinheiten[] = $item;
    }
}