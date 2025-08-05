<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Jbtronics\SettingsBundle\Entity\AbstractSettingsORMEntry;

#[ORM\Entity]
class Setting extends AbstractSettingsORMEntry {
    use IdTrait;
}