<?php

namespace App\View\Filter;

use App\Entity\LerneinheitArt;
use App\Repository\LerneinheitArtRepositoryInterface;
use App\Utils\ArrayUtils;
use Symfony\Component\HttpFoundation\Request;

class LerneinheitArtFilter {
    public function __construct(private readonly LerneinheitArtRepositoryInterface $repository) {

    }

    public function handleRequest(Request $request): LerneinheitArtFilterView {
        $arten = ArrayUtils::createArrayWithKeys(
            $this->repository->findAll(),
            fn(LerneinheitArt $art) => (int)$art->getId()
        );

        $selectedId = $request->query->filter('art', filter: FILTER_VALIDATE_INT, options: [ 'flags' => FILTER_NULL_ON_FAILURE]);
        $selected = null;

        if($selectedId > 0 && array_key_exists($selectedId, $arten)) {
            $selected = $arten[$selectedId];
        }

        return new LerneinheitArtFilterView($arten, $selected);
    }
}