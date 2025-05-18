<?php

namespace OxygenSuite\DigitalClient\Models;

/**
 * @extends ModelArray<Error>
 */
class Errors extends ModelArray
{
    protected array $casts = [
        'error' => Error::class,
    ];

    public function __construct()
    {
        parent::__construct('error');
    }

    public function offsetGet(mixed $offset): Error
    {
        return $this->attributes['error'][$offset];
    }
}
