<?php

namespace OxygenSuite\DigitalClient\Http;

use OxygenSuite\DigitalClient\Exceptions\DCLException;
use OxygenSuite\DigitalClient\Models\UpdateDigitalClient as UpdateClientModel;
use OxygenSuite\DigitalClient\Models\ResponseDoc;
use OxygenSuite\DigitalClient\Models\UpdateClientDoc;
use OxygenSuite\DigitalClient\Xml\ResponseDocReader;
use OxygenSuite\DigitalClient\Xml\UpdateClientDocWriter;

class UpdateClient extends DCLXmlRequest
{
    /**
     * <p>Το σώμα της κλήσης θα πρέπει είναι σε μορφή xml και περιέχει
     * το στοιχείο UpdateClientDoc</p>
     *
     * @param  UpdateClientDoc|UpdateClientModel|UpdateClientModel[]  $updateClient  UpdateClientClientDoc
     * @return ResponseDoc
     * @throws DCLException
     */
    public function handle(UpdateClientDoc|UpdateClientModel|array $updateClient): ResponseDoc
    {
        if (!$updateClient instanceof UpdateClientDoc) {
            $updateClient = new UpdateClientDoc($updateClient);
        }

        return $this->request(new UpdateClientDocWriter(), new ResponseDocReader(), $updateClient);
    }
}
