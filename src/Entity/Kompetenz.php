<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Kompetenz {

    use IdTrait;

    #[Gedmo\SortableGroup]
    #[ORM\ManyToOne(targetEntity: Kompetenzbereich::class)]
    #[ORM\JoinColumn(onDelete: 'cascade')]
    #[Assert\NotNull]
    private ?Kompetenzbereich $kompetenzbereich;

    #[Gedmo\SortablePosition]
    #[ORM\Column(type: 'integer')]
    private int $laufendeNummer = 1;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    private ?string $bezeichnung;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank]
    private ?string $beschreibung;

    public function getKompetenzbereich(): ?Kompetenzbereich {
        return $this->kompetenzbereich;
    }


    public function setKompetenzbereich(?Kompetenzbereich $kompetenzbereich): Kompetenz {
        $this->kompetenzbereich = $kompetenzbereich;
        return $this;
    }

    public function getLaufendeNummer(): int {
        return $this->laufendeNummer;
    }

    public function setLaufendeNummer(int $laufendeNummer): Kompetenz {
        $this->laufendeNummer = $laufendeNummer;
        return $this;
    }

    public function getBezeichnung(): ?string {
        return $this->bezeichnung;
    }

    public function setBezeichnung(?string $bezeichnung): Kompetenz {
        $this->bezeichnung = $bezeichnung;
        return $this;
    }

    public function getBeschreibung(): ?string {
        return $this->beschreibung;
    }

    public function setBeschreibung(?string $beschreibung): Kompetenz {
        $this->beschreibung = $beschreibung;
        return $this;
    }

    public function __toString(): string {
        return sprintf('%s / %s', $this->getKompetenzbereich()->__toString(), $this->getBezeichnung());
    }
}