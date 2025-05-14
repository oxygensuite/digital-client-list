<?php

namespace OxygenSuite\OxygenDcl\Http;

use OxygenSuite\OxygenDcl\Exceptions\DCLException;
use OxygenSuite\OxygenDcl\Models\CreateDigitalClient;
use OxygenSuite\OxygenDcl\Models\NewDigitalClientDoc;
use OxygenSuite\OxygenDcl\Models\ResponseDoc;
use OxygenSuite\OxygenDcl\Xml\CreateClientDocWriter;
use OxygenSuite\OxygenDcl\Xml\ResponseDocReader;

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
