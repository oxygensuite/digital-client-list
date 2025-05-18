<?php

namespace OxygenSuite\DigitalClient\Factories;

use OxygenSuite\DigitalClient\Models\FIMDetail;

class ClientCorrelationFactory extends Factory
{
    public function definition(): array
    {
        $data = [
            'correlateId' => fake()->numerify('########'),
            'entityVatNumber' => fake()->numerify('#########'),
            'mark' => fake()->numerify('#########'),
            'FIM' => FIMDetail::factory()->make(),
            'correlatedDCLids' => [
                fake()->numerify('########'),
                fake()->numerify('########'),
            ],
        ];

        return $data;
    }

    /**
     * Configure the factory to include only mark field
     */
    public function withMark(): static
    {
        return $this->state(function (array $attributes) {
            // Remove FIM if it exists
            if (isset($attributes['FIM'])) {
                unset($attributes['FIM']);
            }

            // Ensure mark exists
            $attributes['mark'] = fake()->numerify('#########');

            return $attributes;
        });
    }

    /**
     * Configure the factory to include only FIM field
     */
    public function withFIM(): static
    {
        return $this->state(function (array $attributes) {
            // Remove mark if it exists
            if (isset($attributes['mark'])) {
                unset($attributes['mark']);
            }

            // Ensure FIM exists
            $attributes['FIM'] = FIMDetail::factory()->make();

            return $attributes;
        });
    }
}
