<?php

namespace App\Repository;

use App\Entity\Jahrgangsstufe;
use App\Entity\Kompetenz;
use App\Entity\ModulInhalt;

class ModulInhaltRepository extends AbstractRepository implements ModulInhaltRepositoryInterface {
    /**
     * @inheritDoc
     */
    public function findAll(): array {
        return $this->em->getRepository(ModulInhalt::class)->findAll();
    }

    public function findBy(Jahrgangsstufe $jahrgangsstufe, Kompetenz $kompetenz): array {
        $qbInner = $this->em->createQueryBuilder()
            ->select('mInner.id')
            ->from(ModulInhalt::class, 'mInner')
            ->leftJoin('mInner.kompetenzen', 'kInner')
            ->leftJoin('mInner.lerneinheiten', 'lInner')
            ->leftJoin('lInner.jahrgangsstufen', 'jInner')
            ->where('kInner.id = :kompetenz')
            ->andWhere('jInner.id = :jgst');

        $qb = $this->em->createQueryBuilder();

        return $qb
            ->select(['m', 'l', 'j', 'f'])
            ->from(ModulInhalt::class, 'm')
            ->leftJoin('m.lerneinheiten', 'l')
            ->leftJoin('l.jahrgangsstufen', 'j')
            ->leftJoin('l.fach', 'f')
            ->where(
                $qb->expr()->in('m.id', $qbInner->getDQL())
            )
            ->setParameter('kompetenz', $kompetenz)
            ->setParameter('jgst', $jahrgangsstufe)
            ->getQuery()
            ->getResult();
    }
}