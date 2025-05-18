<?php

namespace OxygenSuite\DigitalClient\Exceptions;

class InvalidResponseException extends DCLException
{
    public function __construct($message = "Invalid response received from AADE MyData API", $code = 0, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
