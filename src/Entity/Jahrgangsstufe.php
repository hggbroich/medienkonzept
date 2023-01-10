<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Jahrgangsstufe {

    use IdTrait;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    private ?string $bezeichnung;

    #[ORM\ManyToOne(targetEntity: Jahrgang::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'cascade')]
    private ?Jahrgang $jahrgang;

    #[ORM\Column(type: 'integer')]
    #[Assert\GreaterThan(0)]
    private int $halbjahr = 1;

    public function getBezeichnung(): ?string {
        return $this->bezeichnung;
    }

    public function setBezeichnung(?string $bezeichnung): Jahrgangsstufe {
        $this->bezeichnung = $bezeichnung;
        return $this;
    }

    public function getJahrgang(): ?Jahrgang {
        return $this->jahrgang;
    }

    public function setJahrgang(?Jahrgang $jahrgang): Jahrgangsstufe {
        $this->jahrgang = $jahrgang;
        return $this;
    }

    public function getHalbjahr(): int {
        return $this->halbjahr;
    }

    public function setHalbjahr(int $halbjahr): Jahrgangsstufe {
        $this->halbjahr = $halbjahr;
        return $this;
    }

    public function __toString(): string {
        return $this->getBezeichnung();
    }
}