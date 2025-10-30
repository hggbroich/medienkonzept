<?php

namespace App\View\Filter;

use App\Entity\Fach;
use App\Repository\FachRepositoryInterface;
use App\Utils\ArrayUtils;
use Symfony\Component\HttpFoundation\Request;

class FachFilter {
    public function __construct(private readonly FachRepositoryInterface $repository) {

    }

    public function handleRequest(Request $request): FachFilterView {
        $faecher = ArrayUtils::createArrayWithKeys(
            $this->repository->findAll(),
            fn(Fach $fach) => (int)$fach->getId()
        );

        $selectedId = $request->query->filter('fach', filter: FILTER_VALIDATE_INT, options: [ 'flags' => FILTER_NULL_ON_FAILURE]);
        $selected = null;

        if($selectedId > 0 && array_key_exists($selectedId, $faecher)) {
            $selected = $faecher[$selectedId];
        }

        return new FachFilterView($faecher, $selected);
    }
}