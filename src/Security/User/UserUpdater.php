<?php

namespace App\Security\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use LightSaml\SpBundle\Security\Http\Authenticator\SamlToken;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\Event\LoginSuccessEvent;

class UserUpdater implements EventSubscriberInterface {

    public function __construct(private readonly UserMapper $userMapper, private readonly EntityManagerInterface $em)
    {
    }

    public function onLoginSuccess(LoginSuccessEvent $event) {
        $user = $event->getUser();
        $token = $event->getAuthenticatedToken();

        if(!$user instanceof User || !$token instanceof SamlToken) {
            return;
        }

        $this->userMapper->mapUser($user, $token->getAttributes());
        $this->em->persist($user);
        $this->em->flush();
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents(): array {
        return [
            LoginSuccessEvent::class => 'onLoginSuccess'
        ];
    }
}