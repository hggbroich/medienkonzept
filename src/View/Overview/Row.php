<?php

namespace App\View\Overview;

use App\Entity\Fach;
use App\Entity\ModulInhalt;

readonly class Row {
    /**
     * @param Fach $fach
     * @param ModulInhalt[] $inhalte
     */
    public function __construct(public Fach $fach, public array $inhalte) {

    }
}