<?php

namespace App\Menu;

use App\Entity\User;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use LightSaml\SpBundle\Security\Http\Authenticator\SamlToken;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class Builder {
    public function __construct(private readonly FactoryInterface $factory, private readonly AuthorizationCheckerInterface $authorizationChecker) {

    }

    public function mainMenu(): ItemInterface {
        $menu = $this->factory->createItem('root')
            ->setChildrenAttribute('class', 'navbar-nav me-auto');

        $menu->addChild('dashboard.jahrgangsstufe', [
            'route' => 'jgst_redirect'
        ])
            ->setExtra('icon', 'fa fa-home');
        $menu->addChild('dashboard.fach', [
            'route' => 'fach_redirect'
        ])
            ->setExtra('icon', 'fa fa-home');

        if($this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            $menu->addChild('admin.ea.label', [
                'uri' => '/admin/ea'
            ])
                ->setLinkAttribute('target', '_blank')
                ->setExtra('icon', 'fas fa-tools');
        }

        return $menu;
    }
}