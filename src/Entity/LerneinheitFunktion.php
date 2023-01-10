<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class LerneinheitFunktion {

    use IdTrait;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    private ?string $bezeichnung;

    public function getBezeichnung(): ?string {
        return $this->bezeichnung;
    }

    public function setBezeichnung(?string $bezeichnung): LerneinheitFunktion {
        $this->bezeichnung = $bezeichnung;
        return $this;
    }

    public function __toString(): string {
        return $this->getBezeichnung();
    }
}