<?php

namespace OxygenSuite\DigitalClient\Exceptions;

use Throwable;

class DCLConnectionException extends TransmissionFailedException
{
    public function __construct(int $code = 0, Throwable $previous = null)
    {
        parent::__construct("myDATA servers are down or unreachable. Please try again later.", $code, $previous);
    }
}
