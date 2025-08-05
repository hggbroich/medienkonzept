<?php

namespace App\View\Filter;

use App\Entity\Modul;
use App\Repository\ModulRepositoryInterface;
use App\Utils\ArrayUtils;
use Symfony\Component\HttpFoundation\Request;

class ModulFilter {

    public function __construct(private readonly ModulRepositoryInterface $repository) { }

    public function handle(Request $request): ModulFilterView {
        $module = ArrayUtils::createArrayWithKeys(
            $this->repository->findAll(),
            fn(Modul $modul) => (int)$modul->getId()
        );

        $selectedId = $request->query->getInt('modul');
        $selected = null;

        if($selectedId > 0 && array_key_exists($selectedId, $module)) {
            $selected = $module[$selectedId];
        }

        return new ModulFilterView($module, $selected);
    }
}