<?php

namespace OxygenSuite\DigitalClient\Models;

class DigitalClient extends Model
{
    protected array $casts = [
        'InitialClientData' => CreateDigitalClient::class,
        'UpdatedClientData' => UpdateDigitalClient::class,
    ];

    public static function create(): CreateDigitalClient
    {
        return new CreateDigitalClient();
    }

    public static function update(): UpdateDigitalClient
    {
        return new UpdateDigitalClient();
    }

    public static function cancel(): CancelDigitalClient
    {
        return new CancelDigitalClient();
    }

    public function getInitialClientData(): CreateDigitalClient
    {
        return $this->get('InitialClientData');
    }

    public function getUpdatedClientData(): CreateDigitalClient
    {
        return $this->get('UpdatedClientData');
    }
}
