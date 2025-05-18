<?php

namespace OxygenSuite\DigitalClient\Models;

/**
 * @extends ModelArray<UpdateDigitalClient>
 */
class UpdateClientDoc extends ModelArray
{
    protected array $casts = [
        'updateClient' => UpdateDigitalClient::class,
    ];

    /**
     * @param  UpdateDigitalClient|UpdateDigitalClient[]  $clients
     */
    public function __construct(UpdateDigitalClient|array $clients = [])
    {
        parent::__construct('updateClient', $clients);
    }

    public function offsetGet(mixed $offset): UpdateDigitalClient
    {
        return $this->attributes[$this->childKey][$offset];
    }
}
