<?php

namespace OxygenSuite\DigitalClient\Http;

use OxygenSuite\DigitalClient\Exceptions\DCLException;
use OxygenSuite\DigitalClient\Models\CreateDigitalClient;
use OxygenSuite\DigitalClient\Models\NewDigitalClientDoc;
use OxygenSuite\DigitalClient\Models\ResponseDoc;
use OxygenSuite\DigitalClient\Xml\CreateClientDocWriter;
use OxygenSuite\DigitalClient\Xml\ResponseDocReader;

class SendClient extends DCLXmlRequest
{
    /**
     * <p>Το σώμα της κλήσης θα πρέπει είναι σε μορφή xml και περιέχει
     * το στοιχείο NewDigitalClientDoc</p>
     *
     * @param NewDigitalClientDoc|SendClient|SendClient[] $createClient NewDigitalClientDoc
     * @return ResponseDoc
     * @throws DCLException
     */
    public function handle(NewDigitalClientDoc|CreateDigitalClient|array $createClient): ResponseDoc
    {
        if (!$createClient instanceof NewDigitalClientDoc) {
            $createClient = new NewDigitalClientDoc($createClient);
        }

        return $this->request(new CreateClientDocWriter(), new ResponseDocReader(), $createClient);
    }
}
