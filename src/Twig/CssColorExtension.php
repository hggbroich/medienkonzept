<?php

namespace App\Twig;

use App\Utils\ColorUtils;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class CssColorExtension extends AbstractExtension {

    public function __construct(private readonly ColorUtils $colorUtils) {

    }

    public function getFunctions(): array {
        return [
            new TwigFunction('foreground', [ $this, 'foregroundColor']),
        ];
    }

    public function foregroundColor(?string $color): string {
        if(empty($color)) {
            return '';
        }

        return $this->colorUtils->getForeground($color);
    }
}