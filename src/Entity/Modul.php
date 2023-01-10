<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Modul {

    use IdTrait;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    private ?string $bezeichnung;

    #[ORM\OneToMany(mappedBy: 'modul', targetEntity: ModulInhalt::class)]
    private Collection $inhalte;

    public function __construct() {
        $this->inhalte = new ArrayCollection();
    }

    /**
     * @return string|null
     */
    public function getBezeichnung(): ?string {
        return $this->bezeichnung;
    }

    /**
     * @param string|null $bezeichnung
     * @return Modul
     */
    public function setBezeichnung(?string $bezeichnung): Modul {
        $this->bezeichnung = $bezeichnung;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getInhalte(): Collection {
        return $this->inhalte;
    }

    public function addInhalt(ModulInhalt $inhalt): void {
        $this->inhalte->add($inhalt);
    }

    public function removeInhalt(ModulInhalt $inhalt): void {
        $this->inhalte->removeElement($inhalt);
    }

    public function __toString(): string {
        return $this->getBezeichnung();
    }
}