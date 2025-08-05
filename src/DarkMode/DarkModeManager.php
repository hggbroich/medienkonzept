<?php

namespace App\DarkMode;

use SchulIT\CommonBundle\DarkMode\DarkModeManagerInterface;

class DarkModeManager implements DarkModeManagerInterface {

    public function enableDarkMode(): void {    }

    public function disableDarkMode(): void {    }

    public function isDarkModeEnabled(): bool {
        return false;
    }
}