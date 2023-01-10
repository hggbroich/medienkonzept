<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Jahrgang {

    use IdTrait;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    private ?string $bezeichnung;

    public function getBezeichnung(): ?string {
        return $this->bezeichnung;
    }

    public function setBezeichnung(?string $bezeichnung): Jahrgang {
        $this->bezeichnung = $bezeichnung;
        return $this;
    }

    public function __toString() {
        return $this->getBezeichnung();
    }
}