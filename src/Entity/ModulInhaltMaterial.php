<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class ModulInhaltMaterial {

    use IdTrait;

    #[ORM\ManyToOne(targetEntity: ModulInhalt::class, inversedBy: 'materialien')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    #[Assert\NotNull]
    private ?ModulInhalt $inhalt;

    #[ORM\ManyToOne(targetEntity: Material::class)]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    #[Assert\NotNull]
    private ?Material $material;

    #[ORM\Column(type: 'string', nullable: true)]
    #[Assert\NotBlank(allowNull: true)]
    private ?string $detail;

    /**
     * @return ModulInhalt|null
     */
    public function getInhalt(): ?ModulInhalt {
        return $this->inhalt;
    }

    /**
     * @param ModulInhalt|null $inhalt
     * @return ModulInhaltMaterial
     */
    public function setInhalt(?ModulInhalt $inhalt): ModulInhaltMaterial {
        $this->inhalt = $inhalt;
        return $this;
    }

    /**
     * @return Material|null
     */
    public function getMaterial(): ?Material {
        return $this->material;
    }

    /**
     * @param Material|null $material
     * @return ModulInhaltMaterial
     */
    public function setMaterial(?Material $material): ModulInhaltMaterial {
        $this->material = $material;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDetail(): ?string {
        return $this->detail;
    }

    /**
     * @param string|null $detail
     * @return ModulInhaltMaterial
     */
    public function setDetail(?string $detail): ModulInhaltMaterial {
        $this->detail = $detail;
        return $this;
    }

    public function __toString(): string {
        if(!empty($this->detail)) {
            return sprintf('%s (%s)', $this->getMaterial(), $this->getDetail());
        }

        return $this->getMaterial();
    }
}