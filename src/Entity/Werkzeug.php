<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Werkzeug {

    use IdTrait;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    private ?string $bezeichnung;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Assert\NotBlank(allowNull: true)]
    private ?string $beschreibung;

    /**
     * @return string|null
     */
    public function getBezeichnung(): ?string {
        return $this->bezeichnung;
    }

    /**
     * @param string|null $bezeichnung
     * @return Werkzeug
     */
    public function setBezeichnung(?string $bezeichnung): Werkzeug {
        $this->bezeichnung = $bezeichnung;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBeschreibung(): ?string {
        return $this->beschreibung;
    }

    /**
     * @param string|null $beschreibung
     * @return Werkzeug
     */
    public function setBeschreibung(?string $beschreibung): Werkzeug {
        $this->beschreibung = $beschreibung;
        return $this;
    }

    public function __toString(): string {
        return $this->getBezeichnung();
    }
}