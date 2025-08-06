<?php

namespace App\Entity;

use App\Validator\Color;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\Column(type: 'string', nullable: true)]
    #[Assert\NotBlank(allowNull: true)]
    #[Color]
    private ?string $color = null;

    /** @var Collection<int, Kompetenz>  */
    #[ORM\OneToMany(targetEntity: Kompetenz::class, mappedBy: 'kompetenzbereich', cascade: ['persist'], orphanRemoval: true)]
    private Collection $kompetenzen;

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

    public function getColor(): ?string {
        return $this->color;
    }

    public function setColor(?string $color): Kompetenzbereich {
        $this->color = $color;
        return $this;
    }

    /**
     * @return Collection<int, Kompetenz>
     */
    public function getKompetenzen(): Collection {
        return $this->kompetenzen;
    }

    public function __toString(): string {
        return $this->getBezeichnung();
    }
}