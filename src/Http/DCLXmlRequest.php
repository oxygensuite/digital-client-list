<?php

namespace OxygenSuite\DigitalClient\Http;

use OxygenSuite\DigitalClient\Http\Traits\HasRequestDom;
use OxygenSuite\DigitalClient\Http\Traits\HasResponseDom;
use OxygenSuite\DigitalClient\Models\ResponseDoc;
use OxygenSuite\DigitalClient\Xml\XMLReader;
use OxygenSuite\DigitalClient\Xml\XMLWriter;

abstract class DCLXmlRequest extends DCLRequest
{
    use HasRequestDom;
    use HasResponseDom;

    /**
     * @throws DCLException
     */
    protected function request(XMLWriter $writer, XMLReader $reader, mixed $data): ResponseDoc
    {
        // Create the request XML
        $requestXML = $writer->asXML($data);
        $this->requestDom = $writer->getDomDocument();

        // Get the response XML
        $responseXML = $this->post(body: $requestXML);

        // Parse the response XML
        $responseDoc = $reader->parseXML($responseXML);

        $this->responseDom = $reader->getDomDocument();

        return $responseDoc;
    }
}
