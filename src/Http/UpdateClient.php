<?php

namespace OxygenSuite\OxygenDcl\Http;

use OxygenSuite\OxygenDcl\Exceptions\DCLException;
use OxygenSuite\OxygenDcl\Models\UpdateDigitalClient as UpdateClientModel;
use OxygenSuite\OxygenDcl\Models\ResponseDoc;
use OxygenSuite\OxygenDcl\Models\UpdateClientDoc;
use OxygenSuite\OxygenDcl\Xml\ResponseDocReader;
use OxygenSuite\OxygenDcl\Xml\UpdateClientDocWriter;

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
