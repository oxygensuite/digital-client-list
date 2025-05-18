<?php

namespace OxygenSuite\DigitalClient\Factories;

use OxygenSuite\DigitalClient\Enums\ClientServiceType;
use OxygenSuite\DigitalClient\Enums\InvoiceType;
use OxygenSuite\DigitalClient\Enums\OffSiteProvidedServiceType;
use OxygenSuite\DigitalClient\Enums\ProvidedCategoryServiceType;
use OxygenSuite\DigitalClient\Enums\ReasonNonIssueType;

class UpdateDigitalClientFactory extends Factory
{
    public function definition(): array
    {
        return [
            'updateUniqueId' => fake()->uuid(),
            'initialDclId' => fake()->uuid(),
            'clientServiceType' => fake()->randomElement(ClientServiceType::cases()),
            'entryCompletion' => fake()->boolean(),
            'nonIssueInvoice' => fake()->boolean(),
            'amount' => fake()->randomFloat(2, 10, 1000),
            'completionDateTime' => fake()->dateTime()->format('Y-m-d H:i:s'),
            'isDiffVehReturnLocation' => fake()->boolean(),
            'vehicleReturnLocation' => fake()->city(),
            'providedServiceCategory' => fake()->randomElement(ProvidedCategoryServiceType::cases()),
            'providedServiceCategoryOther' => fake()->sentence(),
            'invoiceKind' => fake()->randomElement(InvoiceType::cases()),
            'offSiteProvidedService' => fake()->randomElement(OffSiteProvidedServiceType::cases()),
            'exitDateTime' => fake()->dateTime()->format('Y-m-d H:i:s'),
            'entityVatNumber' => fake()->numerify('EL#########'),
            'cooperatingVatNumber' => fake()->numerify('EL#########'),
            'otherBranch' => fake()->randomNumber(2),
            'reasonNonIssueType' => fake()->randomElement(ReasonNonIssueType::cases()),
            'comments' => fake()->paragraph(),
            'invoiceCounterparty' => fake()->company(),
            'invoiceCounterpartyCountry' => fake()->countryCode(),
        ];
    }
}
