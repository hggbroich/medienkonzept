<?php

namespace App\Security\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use LightSaml\Model\Protocol\Response;
use LightSaml\SpBundle\Security\User\UserCreatorInterface;
use SchulIT\CommonBundle\Saml\ClaimTypes;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

readonly class UserCreator implements UserCreatorInterface {
    public function __construct(private EntityManagerInterface $em, private UserMapper $userMapper) { }

    public function createUser(Response $response): ?UserInterface {
        $id = $response->getFirstAssertion()
            ->getFirstAttributeStatement()
            ->getFirstAttributeByName(ClaimTypes::ID)
            ->getFirstAttributeValue();

        $user = (new User())
            ->setIdpId(Uuid::fromString($id));

        $this->userMapper->mapUser($user, $response);
        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }
}