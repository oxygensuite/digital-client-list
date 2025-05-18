<?php

namespace OxygenSuite\DigitalClient\Factories;

use Faker\Provider\Base as BaseProvider;

class GreekLettersProvider extends BaseProvider
{
    protected static array $letters = [
        'Α',
        'Β',
        'Γ',
        'Δ',
        'Ε',
        'Ζ',
        'Η',
        'Θ',
        'Ι',
        'Κ',
        'Λ',
        'Μ',
        'Ν',
        'Ξ',
        'Ο',
        'Π',
        'Ρ',
        'Σ',
        'Τ',
        'Υ',
        'Φ',
        'Χ',
        'Ψ',
        'Ω',
    ];

    public function greekLetter(): string
    {
        return static::randomElement(static::$letters);
    }

    public function greekLetters(int $count = 3, bool $allowDuplicates = false): string
    {
        if ($allowDuplicates) {
            $letters = array_map(function () {
                return static::randomElement(static::$letters);
            }, range(1, $count));
        } else {
            $letters = static::randomElements(static::$letters, $count);
        }

        return implode('', $letters);
    }
}
