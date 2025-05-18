<?php

namespace OxygenSuite\DigitalClient\Models;

class ClientCorrelationsRequestsDoc extends ModelArray
{
    protected array $casts = [
        'ClientCorrelationsRequest' => ClientCorrelation::class,
    ];

    /**
     * @param  ClientCorrelation|ClientCorrelation[]  $clientCorrelation
     */
    public function __construct(ClientCorrelation|array $clientCorrelation = [])
    {
        parent::__construct('ClientCorrelationsRequest', $clientCorrelation);
    }

    public function offsetGet($offset): ClientCorrelation
    {
        return $this->attributes['ClientCorrelationsRequest'][$offset];
    }
}
