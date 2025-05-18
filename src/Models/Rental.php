<?php

namespace OxygenSuite\DigitalClient\Models;

use OxygenSuite\DigitalClient\Enums\VehicleMovementPurposeType;

class Rental extends Service
{
    protected array $expectedOrder = [
        'vehicleRegistrationNumber',
        'foreignVehicleRegistrationNumber',
        'vehicleCategory',
        'vehicleFactory',
        'vehicleMovementPurpose',
        'isDiffVehPickupLocation',
        'vehiclePickupLocation',
    ];

    public function getVehicleMovementPurpose(): VehicleMovementPurposeType|string|null
    {
        return $this->get('vehicleMovementPurpose');
    }

    public function setVehicleMovementPurpose(VehicleMovementPurposeType|string $vehicleMovementPurpose): static
    {
        return $this->set('vehicleMovementPurpose', $vehicleMovementPurpose);
    }

    public function getIsDiffVehPickupLocation(): ?bool
    {
        return $this->get('isDiffVehPickupLocation');
    }

    public function setIsDiffVehPickupLocation(bool $isDiffVehPickupLocation): static
    {
        return $this->set('isDiffVehPickupLocation', $isDiffVehPickupLocation);
    }

    public function getVehiclePickupLocation(): ?string
    {
        return $this->get('vehiclePickupLocation');
    }

    public function setVehiclePickupLocation(string $vehiclePickupLocation): static
    {
        return $this->set('vehiclePickupLocation', $vehiclePickupLocation);
    }
}
