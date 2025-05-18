<?php

namespace OxygenSuite\DigitalClient\Models;

/**
 * @extends ModelArray<ClientCorrelation>
 */
class ClientCorrelationDoc extends ModelArray
{
    protected array $casts = [
        'clientCorrelation' => ClientCorrelation::class,
    ];

    /**
     * @param  ClientCorrelation|ClientCorrelation[]  $clients
     */
    public function __construct(ClientCorrelation $clientCorrelation)
    {
        parent::__construct('clientCorrelation', $clientCorrelation);
    }

    public function offsetGet(mixed $offset): ClientCorrelation
    {
        return $this->attributes[$this->childKey][$offset];
    }
}
