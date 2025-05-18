<?php

namespace OxygenSuite\DigitalClient\Xml;

use OxygenSuite\DigitalClient\Models\ResponseDoc;

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
