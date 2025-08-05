<?php

namespace App\Controller\Settings;

use App\Menu\AdminMenuBuilder;
use App\Menu\SettingsMenuBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Attribute\Route;

class RedirectToFirstSettingAction extends AbstractController {

    #[Route('/settings', name: 'settings')]
    public function __invoke(SettingsMenuBuilder $builder): RedirectResponse {
        $menu = $builder->settingsMenu();
        $item = $menu->getFirstChild();

        return $this->redirect($item->getUri());
    }
}