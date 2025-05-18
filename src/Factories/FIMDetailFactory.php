<?php

namespace OxygenSuite\DigitalClient\Factories;

class FIMDetailFactory extends Factory
{
    public function definition(): array
    {
        return [
            'FIMNumber' => fake()->numerify('FIM#####'),
            'FIMAA' => fake()->randomLetter.fake()->randomLetter,
            'FIMIssueDate' => fake()->date('Y-m-d'),
            'FIMIssueTime' => fake()->time('H:i:s'),
        ];
    }
}
