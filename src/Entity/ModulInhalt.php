<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class ModulInhalt {

    use IdTrait;

    #[ORM\ManyToOne(targetEntity: Modul::class, inversedBy: 'inhalte')]
    #[ORM\JoinColumn(onDelete: 'cascade')]
    #[Assert\NotNull]
    private ?Modul $modul = null;

    #[ORM\ManyToOne(targetEntity: ModulKompetenzstufe::class)]
    #[ORM\JoinColumn(onDelete: 'cascade')]
    #[Assert\NotNull]
    private ?ModulKompetenzstufe $kompetenzstufe = null;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank]
    private ?string $bezeichnung;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank]
    private ?string $zusammenfassung;

    /** @var Collection<int, Lerneinheit> */
    #[ORM\ManyToMany(targetEntity: Lerneinheit::class, inversedBy: 'modulInhalte')]
    #[ORM\JoinTable]
    #[ORM\JoinColumn(onDelete: 'cascade')]
    #[ORM\InverseJoinColumn(onDelete: 'cascade')]
    private Collection $lerneinheiten;

    /** @var Collection<int, Kompetenz> */
    #[ORM\ManyToMany(targetEntity: Kompetenz::class)]
    #[ORM\JoinTable]
    #[ORM\JoinColumn(onDelete: 'cascade')]
    #[ORM\InverseJoinColumn(onDelete: 'cascade')]
    private Collection $kompetenzen;

    /** @var Collection<int, ModulInhaltMaterial> */
    #[ORM\OneToMany(targetEntity: ModulInhaltMaterial::class, mappedBy: 'inhalt', cascade: ['all'], orphanRemoval: true)]
    #[ORM\InverseJoinColumn(onDelete: 'cascade')]
    private Collection $materialien;

    /** @var Collection<int, Werkzeug> */
    #[ORM\ManyToMany(targetEntity: Werkzeug::class)]
    #[ORM\JoinTable]
    #[ORM\JoinColumn(onDelete: 'cascade')]
    #[ORM\InverseJoinColumn(onDelete: 'cascade')]
    private Collection $werkzeuge;

    public function __construct() {
        $this->lerneinheiten = new ArrayCollection();
        $this->kompetenzen = new ArrayCollection();
        $this->materialien = new ArrayCollection();
        $this->werkzeuge = new ArrayCollection();
    }

    /**
     * @return Modul|null
     */
    public function getModul(): ?Modul {
        return $this->modul;
    }

    /**
     * @param Modul|null $modul
     * @return ModulInhalt
     */
    public function setModul(?Modul $modul): ModulInhalt {
        $this->modul = $modul;
        return $this;
    }

    /**
     * @return ModulKompetenzstufe|null
     */
    public function getKompetenzstufe(): ?ModulKompetenzstufe {
        return $this->kompetenzstufe;
    }

    /**
     * @param ModulKompetenzstufe|null $kompetenzstufe
     * @return ModulInhalt
     */
    public function setKompetenzstufe(?ModulKompetenzstufe $kompetenzstufe): ModulInhalt {
        $this->kompetenzstufe = $kompetenzstufe;
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
     * @return ModulInhalt
     */
    public function setBezeichnung(?string $bezeichnung): ModulInhalt {
        $this->bezeichnung = $bezeichnung;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getZusammenfassung(): ?string {
        return $this->zusammenfassung;
    }

    /**
     * @param string|null $zusammenfassung
     * @return ModulInhalt
     */
    public function setZusammenfassung(?string $zusammenfassung): ModulInhalt {
        $this->zusammenfassung = $zusammenfassung;
        return $this;
    }

    /**
     * @return Collection<int, Lerneinheit>
     */
    public function getLerneinheiten(): Collection {
        return $this->lerneinheiten;
    }

    /**
     * @return Collection<int, Kompetenz>
     */
    public function getKompetenzen(): Collection {
        return $this->kompetenzen;
    }

    public function addMaterialien(ModulInhaltMaterial $material): void {
        $material->setInhalt($this);
        $this->materialien->add($material);
    }

    public function removeMaterialien(ModulInhaltMaterial $material): void {
        $this->materialien->removeElement($material);
    }

    /**
     * @return Collection<int, ModulInhaltMaterial>
     */
    public function getMaterialien(): Collection {
        return $this->materialien;
    }

    /**
     * @return Collection<int, Werkzeug>
     */
    public function getWerkzeuge(): Collection {
        return $this->werkzeuge;
    }

    public function __toString(): string {
        return $this->getBezeichnung();
    }
}