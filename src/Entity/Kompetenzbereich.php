<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Kompetenzbereich {

    use IdTrait;

    #[Gedmo\SortablePosition]
    #[ORM\Column(type: 'integer')]
    #[Assert\GreaterThan(0)]
    private int $laufendeNummer = 1;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    private ?string $bezeichnung;

    public function getLaufendeNummer(): int {
        return $this->laufendeNummer;
    }

    public function setLaufendeNummer(int $laufendeNummer): Kompetenzbereich {
        $this->laufendeNummer = $laufendeNummer;
        return $this;
    }

    public function getBezeichnung(): ?string {
        return $this->bezeichnung;
    }

    public function setBezeichnung(?string $bezeichnung): Kompetenzbereich {
        $this->bezeichnung = $bezeichnung;
        return $this;
    }

    public function __toString(): string {
        return $this->getBezeichnung();
    }
}