<?php

namespace App\DarkMode;

use SchulIT\CommonBundle\DarkMode\DarkModeManagerInterface;

class DarkModeManager implements DarkModeManagerInterface {

    private const Key = 'settings.dark_mode.enabled';

    public function enableDarkMode(): void {    }

    public function disableDarkMode(): void {    }

    public function isDarkModeEnabled(): bool {
        return false;
    }
}