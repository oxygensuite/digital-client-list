<?php

namespace OxygenSuite\DigitalClient\Models;

class UpdateClientRequestsDoc extends ModelArray
{
    protected array $casts = [
        'UpdateClientRequest' => UpdateDigitalClient::class,
    ];

    /**
     * @param  UpdateDigitalClient|UpdateDigitalClient[]  $updateClient
     */
    public function __construct(UpdateDigitalClient|array $updateClient = [])
    {
        parent::__construct('UpdateClientRequest', $updateClient);
    }

    public function offsetGet($offset): UpdateDigitalClient
    {
        return $this->attributes['UpdateClientRequest'][$offset];
    }
}
