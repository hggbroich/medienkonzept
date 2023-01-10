<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Fach {

    use IdTrait;

    #[ORM\Column(type: 'string', unique: true)]
    #[Assert\NotBlank]
    private ?string $kuerzel;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    private ?string $bezeichnung;

    public function getKuerzel(): ?string {
        return $this->kuerzel;
    }

    public function setKuerzel(?string $kuerzel): Fach {
        $this->kuerzel = $kuerzel;
        return $this;
    }

    public function getBezeichnung(): ?string {
        return $this->bezeichnung;
    }

    public function setBezeichnung(?string $bezeichnung): Fach {
        $this->bezeichnung = $bezeichnung;
        return $this;
    }

    public function __toString(): string {
        return $this->getBezeichnung();
    }
}