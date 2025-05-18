<?php

namespace Tests\Models;

use OxygenSuite\DigitalClient\Enums\VehicleMovementPurposeType;
use OxygenSuite\DigitalClient\Models\rental;
use Tests\TestCase;

class RentalTest extends TestCase
{
    public function test_it_can_create_a_rental_model()
    {
        $rental = Rental::make()
            ->setvehicleRegistrationNumber('ΑΒΓ-123')
            ->setForeignVehicleRegistrationNumber('IAS81JH')
            ->setvehicleCategory('car')
            ->setVehicleFactory('Germany')
            ->setVehicleMovementPurpose(VehicleMovementPurposeType::RENTING)
            ->setIsDiffVehPickupLocation(false)
            ->setVehiclePickupLocation('Heraklion 23, 71234');


        $this->assertEquals('ΑΒΓ-123', $rental->getvehicleRegistrationNumber());
        $this->assertEquals('IAS81JH', $rental->getForeignVehicleRegistrationNumber());
        $this->assertEquals('car', $rental->getvehicleCategory());
        $this->assertEquals('Germany', $rental->getVehicleFactory());
        $this->assertEquals(VehicleMovementPurposeType::RENTING, $rental->getVehicleMovementPurpose());
        $this->assertFalse($rental->getIsDiffVehPickupLocation());
        $this->assertEquals('Heraklion 23, 71234', $rental->getVehiclePickupLocation());
    }

    public function test_it_can_create_a_rental_model_from_factory()
    {
        $rental = Rental::factory()->make();

        $this->assertInstanceOf(Rental::class, $rental);
        $this->assertNotEmpty($rental->getvehicleRegistrationNumber());
        $this->assertNotEmpty($rental->getForeignVehicleRegistrationNumber());
        $this->assertNotEmpty($rental->getvehicleCategory());
        $this->assertNotEmpty($rental->getVehicleFactory());
        $this->assertNotEmpty($rental->getVehicleMovementPurpose());
        $this->assertIsBool($rental->getIsDiffVehPickupLocation());
        $this->assertNotEmpty($rental->getVehiclePickupLocation());
    }

    public function test_it_returns_null_for_unset_properties()
    {
        $rental = Rental::make();

        $this->assertNull($rental->getvehicleRegistrationNumber());
        $this->assertNull($rental->getForeignVehicleRegistrationNumber());
        $this->assertNull($rental->getvehicleCategory());
        $this->assertNull($rental->getVehicleFactory());
        $this->assertNull($rental->getVehicleMovementPurpose());
        $this->assertNull($rental->getIsDiffVehPickupLocation());
        $this->assertNull($rental->getVehiclePickupLocation());
    }

    public function test_it_can_be_converted_to_array()
    {
        $rentalArray = Rental::make()
            ->setvehicleRegistrationNumber('ΑΒΓ-123')
            ->setForeignVehicleRegistrationNumber('IAS81JH')
            ->setvehicleCategory('car')
            ->setVehicleFactory('Germany')
            ->setVehicleMovementPurpose(VehicleMovementPurposeType::RENTING)
            ->setIsDiffVehPickupLocation(false)
            ->setVehiclePickupLocation('Heraklion 23, 71234')
            ->toArray();

        $this->assertIsArray($rentalArray);
        $this->assertEquals('ΑΒΓ-123', $rentalArray['vehicleRegistrationNumber']);
        $this->assertEquals('IAS81JH', $rentalArray['foreignVehicleRegistrationNumber']);
        $this->assertEquals('car', $rentalArray['vehicleCategory']);
        $this->assertEquals('Germany', $rentalArray['vehicleFactory']);
        $this->assertEquals(VehicleMovementPurposeType::RENTING, $rentalArray['vehicleMovementPurpose']);
        $this->assertFalse($rentalArray['isDiffVehPickupLocation']);
        $this->assertEquals('Heraklion 23, 71234', $rentalArray['vehiclePickupLocation']);
    }
}
