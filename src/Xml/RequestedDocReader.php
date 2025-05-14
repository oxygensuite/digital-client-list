<?php

namespace OxygenSuite\OxygenDcl\Xml;

use OxygenSuite\OxygenDcl\Models\RequestedDoc;

/**
 * @extends XMLReader<RequestedDoc>
 */
class RequestedDocReader extends XMLReader
{
    public function parseXML(string $xmlString): RequestedDoc
    {
        $doc = new RequestedDoc();
        $this->loadXML($xmlString, $doc);

        return $doc;
    }
}
