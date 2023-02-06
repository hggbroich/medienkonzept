<?php

namespace App\View\Filter;

use App\Entity\LerneinheitFunktion;
use App\Repository\LerneinheitFunktionRepositoryInterface;
use App\Utils\ArrayUtils;
use Symfony\Component\HttpFoundation\Request;

class LerneinheitFunktionFilter {
    public function __construct(private readonly LerneinheitFunktionRepositoryInterface $repository) {

    }

    public function handleRequest(Request $request): LerneinheitFunktionFilterView {
        $funktionen = ArrayUtils::createArrayWithKeys(
            $this->repository->findAll(),
            fn(LerneinheitFunktion $funktion) => $funktion->getId()
        );

        $selectedId = $request->query->getInt('funktion');
        $selected = null;

        if($selectedId > 0 && array_key_exists($selectedId, $funktionen)) {
            $selected = $funktionen[$selectedId];
        }

        return new LerneinheitFunktionFilterView($funktionen, $selected);
    }
}