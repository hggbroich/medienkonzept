<?php

namespace App\View\Filter;

use App\Entity\Jahrgangsstufe;
use App\Repository\JahrgangsstufeRepositoryInterface;
use App\Utils\ArrayUtils;
use Symfony\Component\HttpFoundation\Request;

class JahrgangsstufenFilter {
    public function __construct(private readonly JahrgangsstufeRepositoryInterface $repository) {

    }

    public function handleRequest(Request $request): JahrgangsstufenFilterView {
        $stufen = ArrayUtils::createArrayWithKeys(
            $this->repository->findAll(),
            fn(Jahrgangsstufe $jgst) => (int)$jgst->getId()
        );

        $selectedId = $request->query->getInt('jgst');
        $selected = null;

        if($selectedId > 0 && array_key_exists($selectedId, $stufen)) {
            $selected = $stufen[$selectedId];
        }

        return new JahrgangsstufenFilterView($stufen, $selected);
    }
}