<?php

namespace App\Grouping;

use App\Entity\Fach;
use App\Entity\Lerneinheit;

/**
 * @implements GroupInterface<Fach, Lerneinheit>
 */
class FachLerneinheitenGroup implements GroupInterface {

    /** @var Lerneinheit[] */
    private array $lerneinheiten = [ ];

    public function __construct(private readonly Fach $fach) {

    }

    /**
     * @return Fach
     */
    public function getFach(): Fach {
        return $this->fach;
    }

    /**
     * @return Lerneinheit[]
     */
    public function getLerneinheiten(): array {
        return $this->lerneinheiten;
    }

    public function getKey(): mixed {
        return $this->fach;
    }

    public function addItem($item): void {
        $this->lerneinheiten[] = $item;
    }
}