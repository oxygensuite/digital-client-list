<?php

namespace OxygenSuite\DigitalClient\Models;

class ClientsDoc extends ModelArray
{
    protected array $casts = [
        'DigitalClient' => DigitalClient::class,
    ];

    /**
     * @param  DigitalClient|DigitalClient[]  $digitalClient
     */
    public function __construct(DigitalClient|array $digitalClient = [])
    {
        parent::__construct('DigitalClient', $digitalClient);
    }

    public function offsetGet($offset): DigitalClient
    {
        return $this->attributes['DigitalClient'][$offset];
    }
}
