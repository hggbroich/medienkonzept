<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


trait IdTrait {

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private ?int $id;

    public function getId(): ?int {
        return $this->id;
    }
}