<?php

namespace App\Repository;

use App\Entity\Fach;
use App\Entity\Jahrgangsstufe;
use App\Entity\Kompetenz;
use App\Entity\Lerneinheit;
use App\Entity\Modul;

class LerneinheitRepository extends AbstractRepository implements LerneinheitRepositoryInterface {

    public function findAllByJgstAndSubject(?Jahrgangsstufe $jgst, ?Fach $fach, ?Kompetenz $kompetenz = null, ?Modul $modul = null): array {
        $qb = $this->em->createQueryBuilder()
            ->select(['i', 'mi', 'ks'])
            ->from(Lerneinheit::class, 'i')
            ->innerJoin('i.jahrgangsstufen', 'j')
            ->leftJoin('i.modulInhalte', 'mi')
            ->leftJoin('mi.modul', 'm')
            ->leftJoin('mi.kompetenzstufe', 'ks')
            ->leftJoin('i.fach', 'f')
            ->leftJoin('mi.kompetenzen', 'k')
            ->addOrderBy('m.bezeichnung', 'asc')
            ->addOrderBy('ks.sortierung', 'asc');

        if($jgst !== null) {
            $qb->andWhere('j.id = :jgst')
                ->setParameter('jgst', $jgst->getId());
        }

        if($fach !== null) {
            $qb->andWhere('f.id = :fach')
                ->setParameter('fach', $fach->getId());
        }

        if($kompetenz !== null) {
            $qb->andWhere('k.id = :kompetenz')
                ->setParameter('kompetenz', $kompetenz->getId());
        }

        if($modul !== null) {
            $qb->andWhere('m.id = :modul')
                ->setParameter('modul', $modul->getId());
        }

        return $qb->getQuery()->getResult();
    }
}