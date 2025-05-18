<?php

namespace OxygenSuite\DigitalClient\Factories;

class ServiceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'vehicleRegistrationNumber' => fake()->greekLetters(3).'-'.fake()->randomNumber(4),
            'foreignVehicleRegistrationNumber' => fake()->regexify('[A-Z0-9]{6}'),
            'vehicleCategory' => fake()->word(),
            'vehicleFactory' => fake()->word(),
        ];
    }
}
