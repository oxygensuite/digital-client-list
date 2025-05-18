<?php

namespace OxygenSuite\DigitalClient\Models;

class CancelClientRequestsDoc extends ModelArray
{
    protected array $casts = [
        'CancelClientRequest' => CancelDigitalClient::class,
    ];

    /**
     * @param  CancelDigitalClient|CancelDigitalClient[]  $cancelClient
     */
    public function __construct(CancelDigitalClient|array $cancelClient = [])
    {
        parent::__construct('CancelClientRequest', $cancelClient);
    }

    public function offsetGet($offset): CancelDigitalClient
    {
        return $this->attributes['CancelClientRequest'][$offset];
    }
}
