<?php

namespace App\Repository;

use App\Entity\Fach;
use App\Entity\Jahrgangsstufe;
use App\Entity\Lerneinheit;

class LerneinheitRepository extends AbstractRepository implements LerneinheitRepositoryInterface {

    public function findAllByJgstAndSubject(?Jahrgangsstufe $jgst, ?Fach $fach): array {
        $qb = $this->em->createQueryBuilder()
            ->select(['i', 'mi', 'k'])
            ->from(Lerneinheit::class, 'i')
            ->innerJoin('i.jahrgangsstufen', 'j')
            ->leftJoin('i.modulInhalte', 'mi')
            ->leftJoin('mi.modul', 'm')
            ->leftJoin('mi.kompetenzstufe', 'k')
            ->leftJoin('i.fach', 'f')
            ->addOrderBy('m.bezeichnung', 'asc')
            ->addOrderBy('k.sortierung', 'asc');

        if($jgst !== null) {
            $qb->andWhere('j.id = :jgst')
                ->setParameter('jgst', $jgst->getId());
        }

        if($fach !== null) {
            $qb->andWhere('f.id = :fach')
                ->setParameter('fach', $fach->getId());
        }

        return $qb->getQuery()->getResult();
    }
}