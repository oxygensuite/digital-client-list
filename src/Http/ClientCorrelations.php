<?php

namespace OxygenSuite\OxygenDcl\Http;

use OxygenSuite\OxygenDcl\Exceptions\DCLException;
use OxygenSuite\OxygenDcl\Models\ClientCorrelation;
use OxygenSuite\OxygenDcl\Models\ClientCorrelationDoc;
use OxygenSuite\OxygenDcl\Models\ResponseDoc;
use OxygenSuite\OxygenDcl\Xml\ClientCorrelationDocWriter;
use OxygenSuite\OxygenDcl\Xml\ResponseDocReader;

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
