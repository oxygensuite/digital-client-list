<?php

namespace OxygenSuite\DigitalClient\Exceptions;

use Throwable;

class DCLAuthenticationException extends TransmissionFailedException
{
    public function __construct(int $code = 0, Throwable $previous = null)
    {
        parent::__construct("Authentication failed. Please check your user id and subscription key.", $code, $previous);
    }
}
