<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation\SortablePosition;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class ModulKompetenzstufe {

    use IdTrait;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    private ?string $bezeichnung;

    #[ORM\Column(type: 'integer')]
    #[SortablePosition]
    private int $sortierung = 0;

    public function getBezeichnung(): ?string {
        return $this->bezeichnung;
    }

    public function setBezeichnung(?string $bezeichnung): ModulKompetenzstufe {
        $this->bezeichnung = $bezeichnung;
        return $this;
    }

    /**
     * @return int
     */
    public function getSortierung(): int {
        return $this->sortierung;
    }

    /**
     * @param int $sortierung
     * @return ModulKompetenzstufe
     */
    public function setSortierung(int $sortierung): ModulKompetenzstufe {
        $this->sortierung = $sortierung;
        return $this;
    }

    public function __toString(): string {
        return $this->getBezeichnung();
    }
}