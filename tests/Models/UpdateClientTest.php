<?php

namespace Tests\Models;

use OxygenSuite\DigitalClient\Enums\ClientServiceType;
use OxygenSuite\DigitalClient\Enums\InvoiceType;
use OxygenSuite\DigitalClient\Enums\OffSiteProvidedServiceType;
use OxygenSuite\DigitalClient\Enums\ProvidedCategoryServiceType;
use OxygenSuite\DigitalClient\Enums\ReasonNonIssueType;
use OxygenSuite\DigitalClient\Models\DigitalClient;
use OxygenSuite\DigitalClient\Models\UpdateDigitalClient;
use Tests\TestCase;

class UpdateClientTest extends TestCase
{
    public function test_it_can_create_an_update_client_model()
    {
        $updateClient = DigitalClient::update()
            ->setUpdateUniqueId('abc123')
            ->setInitialDclId('dcl456')
            ->setClientServiceType(ClientServiceType::PARKING_CAR_WASH)
            ->setEntryCompletion(true)
            ->setNonIssueInvoice(false)
            ->setAmount(150.25)
            ->setCompletionDateTime('2025-04-10T20:59:00Z')
            ->setIsDiffVehReturnLocation(true)
            ->setVehicleReturnLocation('Athens')
            ->setProvidedServiceCategory(ProvidedCategoryServiceType::WORK_WITH_PARTS)
            ->setProvidedServiceCategoryOther('Custom Service')
            ->setInvoiceKind(InvoiceType::RETAIL)
            ->setOffSiteProvidedService(OffSiteProvidedServiceType::SAME_ENTITY)
            ->setExitDateTime('2025-04-11T10:00:00Z')
            ->setEntityVatNumber('EL123456789')
            ->setCooperatingVatNumber('EL987654321')
            ->setOtherBranch(42)
            ->setReasonNonIssueType(ReasonNonIssueType::OWN_USE)
            ->setComments('Test comments')
            ->setInvoiceCounterparty('Test Company')
            ->setInvoiceCounterpartyCountry('GR');

        $this->assertEquals('abc123', $updateClient->getUpdateUniqueId());
        $this->assertEquals('dcl456', $updateClient->getInitialDclId());
        $this->assertEquals(ClientServiceType::PARKING_CAR_WASH, $updateClient->getClientServiceType());
        $this->assertTrue($updateClient->getEntryCompletion());
        $this->assertFalse($updateClient->getNonIssueInvoice());
        $this->assertEquals(150.25, $updateClient->getAmount());
        $this->assertEquals('2025-04-10T20:59:00Z', $updateClient->getCompletionDateTime());
        $this->assertTrue($updateClient->getIsDiffVehReturnLocation());
        $this->assertEquals('Athens', $updateClient->getVehicleReturnLocation());
        $this->assertEquals(ProvidedCategoryServiceType::WORK_WITH_PARTS, $updateClient->getProvidedServiceCategory());
        $this->assertEquals('Custom Service', $updateClient->getProvidedServiceCategoryOther());
        $this->assertEquals(InvoiceType::RETAIL, $updateClient->getInvoiceKind());
        $this->assertEquals(OffSiteProvidedServiceType::SAME_ENTITY, $updateClient->getOffSiteProvidedService());
        $this->assertEquals('2025-04-11T10:00:00Z', $updateClient->getExitDateTime());
        $this->assertEquals('EL123456789', $updateClient->getEntityVatNumber());
        $this->assertEquals('EL987654321', $updateClient->getCooperatingVatNumber());
        $this->assertEquals(42, $updateClient->getOtherBranch());
        $this->assertEquals(ReasonNonIssueType::OWN_USE, $updateClient->getReasonNonIssueType());
        $this->assertEquals('Test comments', $updateClient->getComments());
        $this->assertEquals('Test Company', $updateClient->getInvoiceCounterparty());
        $this->assertEquals('GR', $updateClient->getInvoiceCounterpartyCountry());
    }

    public function test_it_can_create_an_update_client_model_from_factory()
    {
        $updateClient = UpdateDigitalClient::factory()->make();

        $this->assertInstanceOf(UpdateDigitalClient::class, $updateClient);
        $this->assertNotEmpty($updateClient->getUpdateUniqueId());
        $this->assertNotEmpty($updateClient->getInitialDclId());
        $this->assertInstanceOf(ClientServiceType::class, $updateClient->getClientServiceType());
        $this->assertIsBool($updateClient->getEntryCompletion());
        $this->assertIsBool($updateClient->getNonIssueInvoice());
        $this->assertIsFloat($updateClient->getAmount());
        $this->assertNotEmpty($updateClient->getCompletionDateTime());
        $this->assertIsBool($updateClient->getIsDiffVehReturnLocation());
        $this->assertNotEmpty($updateClient->getVehicleReturnLocation());
        $this->assertInstanceOf(ProvidedCategoryServiceType::class, $updateClient->getProvidedServiceCategory());
        $this->assertNotEmpty($updateClient->getProvidedServiceCategoryOther());
        $this->assertInstanceOf(InvoiceType::class, $updateClient->getInvoiceKind());
        $this->assertInstanceOf(OffSiteProvidedServiceType::class, $updateClient->getOffSiteProvidedService());
        $this->assertNotEmpty($updateClient->getExitDateTime());
        $this->assertNotEmpty($updateClient->getEntityVatNumber());
        $this->assertNotEmpty($updateClient->getCooperatingVatNumber());
        $this->assertIsInt($updateClient->getOtherBranch());
        $this->assertInstanceOf(ReasonNonIssueType::class, $updateClient->getReasonNonIssueType());
        $this->assertNotEmpty($updateClient->getComments());
        $this->assertNotEmpty($updateClient->getInvoiceCounterparty());
        $this->assertNotEmpty($updateClient->getInvoiceCounterpartyCountry());
    }
}
