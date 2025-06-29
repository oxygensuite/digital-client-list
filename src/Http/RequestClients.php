<?php

namespace OxygenSuite\DigitalClient\Http;

use OxygenSuite\DigitalClient\Exceptions\DCLException;
use OxygenSuite\DigitalClient\Models\RequestedDoc;

class RequestClients extends DCLGetRequest
{

    /**
     * @throws DCLException
     */
    public static function only($dclID): RequestedDoc
    {
        return self::handle($dclID-1, $dclID);
    }
}
