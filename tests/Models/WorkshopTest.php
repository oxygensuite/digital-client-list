<?php

namespace Tests\Models;

use OxygenSuite\DigitalClient\Models\Workshop;
use Tests\TestCase;

class WorkshopTest extends TestCase
{
    public function test_it_can_create_a_workshop_model()
    {
        $workshop = Workshop::make()
            ->setvehicleRegistrationNumber('ΑΒΓ-123')
            ->setForeignVehicleRegistrationNumber('IAS81JH')
            ->setvehicleCategory('car')
            ->setVehicleFactory('Germany');


        $this->assertEquals('ΑΒΓ-123', $workshop->getvehicleRegistrationNumber());
        $this->assertEquals('IAS81JH', $workshop->getForeignVehicleRegistrationNumber());
        $this->assertEquals('car', $workshop->getvehicleCategory());
        $this->assertEquals('Germany', $workshop->getVehicleFactory());
    }

    public function test_it_can_create_a_parking_car_wash_model_from_factory()
    {
        $workshop = Workshop::factory()->make();

        $this->assertInstanceOf(Workshop::class, $workshop);
        $this->assertNotEmpty($workshop->getvehicleRegistrationNumber());
        $this->assertNotEmpty($workshop->getForeignVehicleRegistrationNumber());
        $this->assertNotEmpty($workshop->getvehicleCategory());
        $this->assertNotEmpty($workshop->getVehicleFactory());
    }

    public function test_it_returns_null_for_unset_properties()
    {
        $workshop = Workshop::make();

        $this->assertNull($workshop->getvehicleRegistrationNumber());
        $this->assertNull($workshop->getForeignVehicleRegistrationNumber());
        $this->assertNull($workshop->getvehicleCategory());
        $this->assertNull($workshop->getVehicleFactory());
    }

    public function test_it_can_be_converted_to_array()
    {
        $workshop = Workshop::make()
            ->setvehicleRegistrationNumber('ΑΒΓ-123')
            ->setForeignVehicleRegistrationNumber('IAS81JH')
            ->setvehicleCategory('car')
            ->setVehicleFactory('Germany');

        $array = $workshop->toArray();

        $this->assertIsArray($array);
        $this->assertEquals('ΑΒΓ-123', $array['vehicleRegistrationNumber']);
        $this->assertEquals('IAS81JH', $array['foreignVehicleRegistrationNumber']);
        $this->assertEquals('car', $array['vehicleCategory']);
        $this->assertEquals('Germany', $array['vehicleFactory']);
    }
}
