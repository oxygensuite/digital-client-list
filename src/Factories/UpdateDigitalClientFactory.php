<?php

namespace OxygenSuite\OxygenDcl\Factories;

use OxygenSuite\OxygenDcl\Enums\ClientServiceType;
use OxygenSuite\OxygenDcl\Enums\InvoiceType;
use OxygenSuite\OxygenDcl\Enums\OffSiteProvidedServiceType;
use OxygenSuite\OxygenDcl\Enums\ProvidedCategoryServiceType;
use OxygenSuite\OxygenDcl\Enums\ReasonNonIssueType;

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
