<?php

namespace App\Menu;

use App\Entity\User;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class UserMenuBuilder extends AbstractMenuBuilder {

    public function __construct(#[Autowire(env: 'IDP_PROFILE_URL')] private readonly string $idpProfileUrl,
                                FactoryInterface $factory, TokenStorageInterface $tokenStorage,
                                AuthorizationCheckerInterface $authorizationChecker, TranslatorInterface $translator) {
        parent::__construct($factory, $tokenStorage, $authorizationChecker, $translator);
    }

    public function userMenu(array $options): ItemInterface {
        $menu = $this->factory->createItem('root')
            ->setChildrenAttributes([
                'class' => 'navbar-nav float-lg-right'
            ]);

        if($this->tokenStorage->getToken() === null) {
            return $menu;
        }

        $user = $this->tokenStorage->getToken()->getUser();

        if(!$user instanceof User) {
            return $menu;
        }

        $displayName = $user->getUsername();

        $userMenu = $menu->addChild('user', [
            'label' => $displayName
        ])
            ->setExtra('icon', 'fa fa-user')
            ->setExtra('menu', 'user')
            ->setExtra('menu-container', '#submenu')
            ->setExtra('pull-right', true);

        $userMenu->addChild('profile.label', [
            'uri' => $this->idpProfileUrl
        ])
            ->setLinkAttribute('target', '_blank')
            ->setExtra('icon', 'fas fa-address-card');


        $menu->addChild('label.logout', [
            'route' => 'logout',
            'label' => ''
        ])
            ->setExtra('icon', 'fas fa-sign-out-alt')
            ->setAttribute('title', $this->translator->trans('auth.logout'));

        return $menu;
    }
}