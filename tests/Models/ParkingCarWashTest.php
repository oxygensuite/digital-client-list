<?php

namespace Tests\Models;

use OxygenSuite\DigitalClient\Models\ParkingCarWash;
use Tests\TestCase;

class ParkingCarWashTest extends TestCase
{
    public function test_it_can_create_a_parking_car_wash_model()
    {
        $parkingCarWash = ParkingCarWash::make()
            ->setvehicleRegistrationNumber('ΑΒΓ-123')
            ->setForeignVehicleRegistrationNumber('IAS81JH')
            ->setvehicleCategory('car')
            ->setVehicleFactory('Germany');


        $this->assertEquals('ΑΒΓ-123', $parkingCarWash->getvehicleRegistrationNumber());
        $this->assertEquals('IAS81JH', $parkingCarWash->getForeignVehicleRegistrationNumber());
        $this->assertEquals('car', $parkingCarWash->getvehicleCategory());
        $this->assertEquals('Germany', $parkingCarWash->getVehicleFactory());
    }

    public function test_it_can_create_a_parking_car_wash_model_from_factory()
    {
        $parkingCarWash = ParkingCarWash::factory()->make();

        $this->assertInstanceOf(ParkingCarWash::class, $parkingCarWash);
        $this->assertNotEmpty($parkingCarWash->getvehicleRegistrationNumber());
        $this->assertNotEmpty($parkingCarWash->getForeignVehicleRegistrationNumber());
        $this->assertNotEmpty($parkingCarWash->getvehicleCategory());
        $this->assertNotEmpty($parkingCarWash->getVehicleFactory());
    }

    public function test_it_returns_null_for_unset_properties()
    {
        $parkingCarWash = ParkingCarWash::make();

        $this->assertNull($parkingCarWash->getvehicleRegistrationNumber());
        $this->assertNull($parkingCarWash->getForeignVehicleRegistrationNumber());
        $this->assertNull($parkingCarWash->getvehicleCategory());
        $this->assertNull($parkingCarWash->getVehicleFactory());
    }

    public function test_it_can_be_converted_to_array()
    {
        $parkingCarWashArray = ParkingCarWash::make()
            ->setvehicleRegistrationNumber('ΑΒΓ-123')
            ->setForeignVehicleRegistrationNumber('IAS81JH')
            ->setvehicleCategory('car')
            ->setVehicleFactory('Germany')
            ->toArray();

        $this->assertIsArray($parkingCarWashArray);
        $this->assertEquals('ΑΒΓ-123', $parkingCarWashArray['vehicleRegistrationNumber']);
        $this->assertEquals('IAS81JH', $parkingCarWashArray['foreignVehicleRegistrationNumber']);
        $this->assertEquals('car', $parkingCarWashArray['vehicleCategory']);
        $this->assertEquals('Germany', $parkingCarWashArray['vehicleFactory']);
    }
}
