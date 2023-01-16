<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Lerneinheit {

    use IdTrait;

    #[ORM\ManyToOne(targetEntity: LerneinheitArt::class)]
    #[ORM\JoinColumn(onDelete: 'cascade')]
    #[Assert\NotNull]
    private ?LerneinheitArt $art = null;

    #[ORM\ManyToOne(targetEntity: Fach::class)]
    #[ORM\JoinColumn(onDelete: 'cascade')]
    #[Assert\NotNull]
    private ?Fach $fach = null;

    #[ORM\ManyToOne(targetEntity: LerneinheitFunktion::class)]
    #[ORM\JoinColumn(onDelete: 'cascade')]
    #[Assert\NotNull]
    private ?LerneinheitFunktion $funktion = null;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    private ?string $bezeichnung;

    #[ORM\Column(type: 'integer')]
    #[Assert\GreaterThan(0)]
    private int $stundenumfang = 0;

    #[ORM\ManyToMany(targetEntity: Jahrgangsstufe::class)]
    #[ORM\JoinTable]
    #[ORM\JoinColumn(onDelete: 'cascade')]
    #[ORM\InverseJoinColumn(onDelete: 'cascade')]
    #[Assert\Count(min: 1)]
    /** @var Collection<Jahrgangsstufe> $jahrgangsstufen */
    private Collection $jahrgangsstufen;

    #[ORM\ManyToMany(targetEntity: ModulInhalt::class, mappedBy: 'lerneinheiten')]
    private Collection $modulInhalte;

    public function __construct() {
        $this->jahrgangsstufen = new ArrayCollection();
        $this->modulInhalte = new ArrayCollection();
    }

    /**
     * @return LerneinheitArt|null
     */
    public function getArt(): ?LerneinheitArt {
        return $this->art;
    }

    /**
     * @param LerneinheitArt|null $art
     * @return Lerneinheit
     */
    public function setArt(?LerneinheitArt $art): Lerneinheit {
        $this->art = $art;
        return $this;
    }

    /**
     * @return Fach|null
     */
    public function getFach(): ?Fach {
        return $this->fach;
    }

    /**
     * @param Fach|null $fach
     * @return Lerneinheit
     */
    public function setFach(?Fach $fach): Lerneinheit {
        $this->fach = $fach;
        return $this;
    }

    /**
     * @return LerneinheitFunktion|null
     */
    public function getFunktion(): ?LerneinheitFunktion {
        return $this->funktion;
    }

    /**
     * @param LerneinheitFunktion|null $funktion
     * @return Lerneinheit
     */
    public function setFunktion(?LerneinheitFunktion $funktion): Lerneinheit {
        $this->funktion = $funktion;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBezeichnung(): ?string {
        return $this->bezeichnung;
    }

    /**
     * @param string|null $bezeichnung
     * @return Lerneinheit
     */
    public function setBezeichnung(?string $bezeichnung): Lerneinheit {
        $this->bezeichnung = $bezeichnung;
        return $this;
    }

    /**
     * @return int
     */
    public function getStundenumfang(): int {
        return $this->stundenumfang;
    }

    /**
     * @param int $stundenumfang
     * @return Lerneinheit
     */
    public function setStundenumfang(int $stundenumfang): Lerneinheit {
        $this->stundenumfang = $stundenumfang;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getJahrgangsstufen(): Collection {
        return $this->jahrgangsstufen;
    }

    public function addJahrgangsstufe(Jahrgangsstufe $jahrgangsstufe): void {
        $this->jahrgangsstufen->add($jahrgangsstufe);
    }

    public function removeJahrgangsstufe(Jahrgangsstufe $jahrgangsstufe): void {
        $this->jahrgangsstufen->removeElement($jahrgangsstufe);
    }

    /**
     * @return Collection
     */
    public function getModulInhalte(): Collection {
        return $this->modulInhalte;
    }

    public function __toString(): string {
        if(!empty($this->fach)) {
            return sprintf('%s (%s)', $this->getBezeichnung(), $this->getFach()->getBezeichnung());
        }

        return $this->getBezeichnung();
    }

}