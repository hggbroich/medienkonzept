<?php

namespace App\Repository;

use App\Entity\Jahrgangsstufe;
use Override;

class JahrgangsstufeRepository extends AbstractRepository implements JahrgangsstufeRepositoryInterface {

    public function findAll(): array {
        return $this->em->getRepository(Jahrgangsstufe::class)
            ->findBy([], [
                'bezeichnung' => 'asc'
            ]);
    }


    #[Override]
    public function findAllByJahrgaenge(array $bezeichnung): array {
        return $this->em->createQueryBuilder()
            ->select('j')
            ->from(Jahrgangsstufe::class, 'j')
            ->leftJoin('j.jahrgang', 'jg')
            ->where('jg.bezeichnung IN(:bezeichnung)')
            ->setParameter('bezeichnung', $bezeichnung)
            ->orderBy('jg.bezeichnung', 'ASC')
            ->addOrderBy('j.halbjahr', 'ASC')
            ->getQuery()
            ->getResult();
    }
}