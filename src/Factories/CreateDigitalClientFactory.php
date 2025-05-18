<?php

namespace OxygenSuite\DigitalClient\Factories;

use OxygenSuite\DigitalClient\Enums\ClientServiceType;
use OxygenSuite\DigitalClient\Models\Workshop;

class CreateDigitalClientFactory extends Factory
{
    public function definition(): array
    {
        return [
            'idDcl' => fake()->uuid,
            'clientServiceType' => fake()->randomElement(ClientServiceType::cases()),
            'creationDateTime' => fake()->dateTime->format('Y-m-d\TH:i:sZ'),
            'entityVatNumber' => fake()->numerify('#########'),
            'branch' => fake()->numberBetween(1, 10),
            'recurringService' => fake()->boolean,
            'continuousService' => fake()->boolean,
            'fromAgreedPeriodDate' => fake()->date('Y-m-d'),
            'toAgreedPeriodDate' => fake()->date('Y-m-d'),
            'mixedService' => fake()->boolean,
            'customerVatNumber' => fake()->numerify('#########'),
            'customerCountry' => fake()->countryCode,
            'transmissionFailure' => fake()->numberBetween(1, 1),
            'correlatedDclId' => fake()->uuid,
            'comments' => fake()->sentence,
            'useCase' => ['garage' => Workshop::factory()->make()],
            'periodicity' => fake()->numberBetween(1, 12),
        ];
    }
}
