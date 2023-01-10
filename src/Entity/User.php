<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity]
class User implements UserInterface {

    use IdTrait;

    #[ORM\Column(type: 'uuid', unique: true)]
    private Uuid $idpId;

    #[ORM\Column(type: 'string')]
    private string $username;

    #[ORM\Column(type: 'string')]
    private string $firstname;

    #[ORM\Column(type: 'string')]
    private string $lastname;

    #[ORM\Column(type: 'json')]
    private array $roles = [ 'ROLE_USER' ];

    public function getIdpId(): Uuid {
        return $this->idpId;
    }

    public function setIdpId(Uuid $idpId): User {
        $this->idpId = $idpId;
        return $this;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function setUsername(string $username): User {
        $this->username = $username;
        return $this;
    }

    public function getFirstname(): string {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): User {
        $this->firstname = $firstname;
        return $this;
    }

    public function getLastname(): string {
        return $this->lastname;
    }

    public function setLastname(string $lastname): User {
        $this->lastname = $lastname;
        return $this;
    }

    public function setRoles(array $roles): User {
        $this->roles = $roles;
        return $this;
    }

    public function getRoles(): array {
        return $this->roles;
    }

    public function eraseCredentials() { }

    public function getUserIdentifier(): string {
        return $this->username;
    }

    public function __serialize(): array {
        return [
            'id' => $this->getId(),
            'username' => $this->getUsername()
        ];
    }

    public function __unserialize(array $data): void {
        $this->id = $data['id'] ?? null;
        $this->username = $data['username'];
    }

    public function __toString() {
        return $this->getUserIdentifier();
    }
}