<?php

namespace OxygenSuite\DigitalClient\Http;

use OxygenSuite\DigitalClient\Exceptions\DCLException;
use OxygenSuite\DigitalClient\Models\ClientCorrelation;
use OxygenSuite\DigitalClient\Models\ClientCorrelationDoc;
use OxygenSuite\DigitalClient\Models\ResponseDoc;
use OxygenSuite\DigitalClient\Xml\ClientCorrelationDocWriter;
use OxygenSuite\DigitalClient\Xml\ResponseDocReader;

class ClientCorrelations extends DCLXmlRequest
{
    /**
     * <p>Το σώμα της κλήσης θα πρέπει είναι σε μορφή xml και περιέχει
     * το στοιχείο ClientCorrelationDoc</p>
     *
     * @param ClientCorrelationDoc|ClientCorrelation|ClientCorrelation[] $clientCorrelation NewDigitalClientDoc
     * @return ResponseDoc
     * @throws DCLException
     */
    public function handle(ClientCorrelationDoc|ClientCorrelation|array $clientCorrelation): ResponseDoc
    {
        if (!$clientCorrelation instanceof ClientCorrelationDoc) {
            $clientCorrelation = new ClientCorrelationDoc($clientCorrelation);
        }

        return $this->request(new ClientCorrelationDocWriter(), new ResponseDocReader(), $clientCorrelation);
    }
}
