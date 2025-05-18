<?php

namespace OxygenSuite\DigitalClient\Xml;

class CreateClientDocWriter extends XMLWriter
{
    private const DOC_VERSION = 'v1.0';

    private const XMLNS = 'http://www.aade.gr/myDATA/dcrnew/v1.0';
    private const XSI = 'http://www.w3.org/2001/XMLSchema-instance';
    private const SCHEMA_LOCATION = "http://www.aade.gr/myDATA/dcrnew/v1.0 SendClient-".self::DOC_VERSION.".xsd";

    /** @noinspection PhpUnhandledExceptionInspection */
    public function asXML($data): string
    {
        $rootNode = $this->document->createElementNS(self::XMLNS, 'NewDigitalClientDoc');
        $this->document->appendChild($rootNode);

        $rootNode->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:xsi', self::XSI);
        //        $rootNode->setAttributeNS('http://www.w3.org/2001/XMLSchema-instance', 'xsi:schemaLocation', self::SCHEMA_LOCATION);

        $this->buildArray($rootNode, 'newDigitalClient', iterator_to_array($data));

        return $this->document->saveXML();
    }
}
