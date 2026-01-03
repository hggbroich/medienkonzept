<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\FileExtensionEscapingStrategy;
use Twig\TwigFilter;

class StringExtension extends AbstractExtension {
    public function getFilters() {
        return [
            new TwigFilter('enumerate', [$this, 'enumerate']),
        ];
    }

    public function enumerate(array $values, string $separator = ', ', string $lastSeperator = 'und'): string {
        return sprintf(
            '%s %s %s',
            implode($separator, array_slice($values, 0, -1)),
            $lastSeperator,
            array_last($values)
        );
    }
}