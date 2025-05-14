<?php

namespace OxygenSuite\OxygenDcl\Xml;

use OxygenSuite\OxygenDcl\Models\ResponseDoc;

/**
 * @extends XMLReader<ResponseDoc>
 */
class ResponseDocReader extends XMLReader
{
    public function parseXML(string $xmlString): ResponseDoc
    {
        $doc = new ResponseDoc();
        $this->loadXML($xmlString, $doc);

        return $doc;
    }
}
