<?php

namespace Tests\Models;

use OxygenSuite\DigitalClient\Enums\ClientServiceType;
use OxygenSuite\DigitalClient\Models\CreateDigitalClient;
use OxygenSuite\DigitalClient\Models\DigitalClient;
use OxygenSuite\DigitalClient\Models\ParkingCarWash;
use OxygenSuite\DigitalClient\Models\Service;
use Tests\TestCase;

class CreateClientTest extends TestCase
{
    public function test_it_can_create_a_new_digital_client_model()
    {
        $newDigitalClient = DigitalClient::create()
            ->setidDcl('1234567890')
            ->setclientServiceType(ClientServiceType::PARKING_CAR_WASH)
            ->setCreationDateTime('2025-04-10T20:59:00Z')
            ->setEntityVatNumber('123456789')
            ->setBranch(0)
            ->setRecurringService(false)
            ->setContinuousService(false)
            ->setFromAgreedPeriodDate('2025-04-10')
            ->setToAgreedPeriodDate('2025-05-10')
            ->setMixedService(false)
            ->setCustomerVatNumber('123456789')
            ->setCustomerCountry('GR')
            ->setTransmissionFailure(0)
            ->setCorrelatedDclId('123456789')
            ->setComments('Comments Comments')
            ->setUseCase(ParkingCarWash::factory()->make())
            ->setPeriodicity(1)
            ->setContinuousLeaseService(true)
            ->setPeriodicityOther('TEST TEST');

        $this->assertEquals('1234567890', $newDigitalClient->getidDcl());
        $this->assertEquals(ClientServiceType::PARKING_CAR_WASH, $newDigitalClient->getclientServiceType());
        $this->assertEquals('2025-04-10T20:59:00Z', $newDigitalClient->getCreationDateTime());
        $this->assertEquals('123456789', $newDigitalClient->getEntityVatNumber());
        $this->assertEquals(0, $newDigitalClient->getBranch());
        $this->assertFalse($newDigitalClient->getRecurringService());
        $this->assertFalse($newDigitalClient->getContinuousService());
        $this->assertEquals('2025-04-10', $newDigitalClient->getFromAgreedPeriodDate());
        $this->assertEquals('2025-05-10', $newDigitalClient->getToAgreedPeriodDate());
        $this->assertFalse($newDigitalClient->getMixedService());
        $this->assertEquals('123456789', $newDigitalClient->getCustomerVatNumber());
        $this->assertEquals('GR', $newDigitalClient->getCustomerCountry());
        $this->assertEquals(0, $newDigitalClient->getTransmissionFailure());
        $this->assertEquals('123456789', $newDigitalClient->getCorrelatedDclId());
        $this->assertEquals('Comments Comments', $newDigitalClient->getComments());
        $this->assertInstanceOf(ParkingCarWash::class, $newDigitalClient->getUseCase());
        $this->assertEquals(1, $newDigitalClient->getPeriodicity());
        $this->assertTrue($newDigitalClient->getContinuousLeaseService());
        $this->assertEquals('TEST TEST', $newDigitalClient->getPeriodicityOther());
    }

    public function test_it_can_create_a_new_digital_client_model_from_factory()
    {
        $newDigitalClient = DigitalClient::create()->factory()->make();

        $this->assertInstanceOf(CreateDigitalClient::class, $newDigitalClient);
        $this->assertNotEmpty($newDigitalClient->getidDcl());
        $this->assertInstanceOf(ClientServiceType::class, $newDigitalClient->getclientServiceType());
        $this->assertNotEmpty($newDigitalClient->getCreationDateTime());
        $this->assertNotEmpty($newDigitalClient->getEntityVatNumber());
        $this->assertNotEmpty($newDigitalClient->getBranch());
        $this->assertIsBool($newDigitalClient->getRecurringService());
        $this->assertIsBool($newDigitalClient->getContinuousService());
        $this->assertNotEmpty($newDigitalClient->getFromAgreedPeriodDate());
        $this->assertNotEmpty($newDigitalClient->getToAgreedPeriodDate());
        $this->assertIsBool($newDigitalClient->getMixedService());
        $this->assertNotEmpty($newDigitalClient->getCustomerVatNumber());
        $this->assertNotEmpty($newDigitalClient->getCustomerCountry());
        $this->assertNotEmpty($newDigitalClient->getTransmissionFailure());
        $this->assertNotEmpty($newDigitalClient->getCorrelatedDclId());
        $this->assertNotEmpty($newDigitalClient->getComments());
        $this->assertInstanceOf(Service::class, $newDigitalClient->getUseCase());
        $this->assertNotEmpty($newDigitalClient->getPeriodicity());
        $this->assertIsBool($newDigitalClient->getContinuousLeaseService());
        $this->assertNotEmpty($newDigitalClient->getPeriodicityOther());
    }
}
