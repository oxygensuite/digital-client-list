<?php

namespace OxygenSuite\DigitalClient\Models;

use OxygenSuite\DigitalClient\Traits\HasFactory;

abstract class Service extends Model
{
    use HasFactory;

    protected array $expectedOrder = [
        'vehicleRegistrationNumber',
        'foreignVehicleRegistrationNumber',
        'vehicleCategory',
        'vehicleFactory',
    ];

    /**
     * @return string|null Αριθμός Κυκλοφορίας Οχήματος
     */
    public function getVehicleRegistrationNumber(): ?string
    {
        return $this->get('vehicleRegistrationNumber');
    }

    public function setVehicleRegistrationNumber(string $vehicleRegistrationNumber): static
    {
        return $this->set('vehicleRegistrationNumber', $vehicleRegistrationNumber);
    }

    public function getForeignVehicleRegistrationNumber(): ?string
    {
        return $this->get('foreignVehicleRegistrationNumber');
    }

    public function setForeignVehicleRegistrationNumber(string $foreignVehicleRegistrationNumber): static
    {
        return $this->set('foreignVehicleRegistrationNumber', $foreignVehicleRegistrationNumber);
    }

    public function getVehicleCategory(): ?string
    {
        return $this->get('vehicleCategory');
    }

    public function setVehicleCategory(string $vehicleCategory): static
    {
        return $this->set('vehicleCategory', $vehicleCategory);
    }

    public function getVehicleFactory(): ?string
    {
        return $this->get('vehicleFactory');
    }

    public function setVehicleFactory(string $vehicleFactory): static
    {
        return $this->set('vehicleFactory', $vehicleFactory);
    }

    public function name(): string
    {
        return strtolower((new \ReflectionClass($this))->getShortName());
    }
}
