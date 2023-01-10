<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Material {

    use IdTrait;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    private ?string $bezeichnung;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Assert\NotBlank]
    private ?string $quelle;

    #[ORM\ManyToOne(targetEntity: MaterialArt::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    private ?MaterialArt $art;

    #[ORM\ManyToOne(targetEntity: MaterialVerfuegbarkeit::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    private ?MaterialVerfuegbarkeit $verfuegbarkeit;

    /**
     * @return string|null
     */
    public function getBezeichnung(): ?string {
        return $this->bezeichnung;
    }

    /**
     * @param string|null $bezeichnung
     * @return Material
     */
    public function setBezeichnung(?string $bezeichnung): Material {
        $this->bezeichnung = $bezeichnung;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getQuelle(): ?string {
        return $this->quelle;
    }

    /**
     * @param string|null $quelle
     * @return Material
     */
    public function setQuelle(?string $quelle): Material {
        $this->quelle = $quelle;
        return $this;
    }

    /**
     * @return MaterialArt|null
     */
    public function getArt(): ?MaterialArt {
        return $this->art;
    }

    /**
     * @param MaterialArt|null $art
     * @return Material
     */
    public function setArt(?MaterialArt $art): Material {
        $this->art = $art;
        return $this;
    }

    /**
     * @return MaterialVerfuegbarkeit|null
     */
    public function getVerfuegbarkeit(): ?MaterialVerfuegbarkeit {
        return $this->verfuegbarkeit;
    }

    /**
     * @param MaterialVerfuegbarkeit|null $verfuegbarkeit
     * @return Material
     */
    public function setVerfuegbarkeit(?MaterialVerfuegbarkeit $verfuegbarkeit): Material {
        $this->verfuegbarkeit = $verfuegbarkeit;
        return $this;
    }

    public function __toString(): string {
        return $this->getBezeichnung();
    }
}