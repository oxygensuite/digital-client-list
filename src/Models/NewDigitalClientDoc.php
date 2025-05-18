<?php

namespace OxygenSuite\DigitalClient\Models;

/**
 * @extends ModelArray<CreateDigitalClient>
 */
class NewDigitalClientDoc extends ModelArray
{
    protected array $casts = [
        'newDigitalClient' => CreateDigitalClient::class,
    ];

    /**
     * @param  CreateDigitalClient|CreateDigitalClient[]  $clients
     */
    public function __construct(CreateDigitalClient|array $clients = [])
    {
        parent::__construct('newDigitalClient', $clients);
    }

    public function offsetGet(mixed $offset): CreateDigitalClient
    {
        return $this->attributes[$this->childKey][$offset];
    }
}
