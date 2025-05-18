<?php

namespace OxygenSuite\DigitalClient\Xml;

use DOMDocument;
use DOMElement;
use OxygenSuite\DigitalClient\Models\Model;
use IteratorAggregate;

/**
 * @template T of Model
 */
abstract class XMLReader
{
    private DOMDocument $document;

    protected function loadXML(string $xmlString, Model $parent): void
    {
        $this->document = new DOMDocument();
        $this->document->preserveWhiteSpace = false;
        $this->document->formatOutput = true;
        $this->document->loadXML($xmlString);

        $this->parseDOMElement($this->document->documentElement->childNodes, $parent);
    }

    /**
     * Parse the XML node and return the corresponding Model object.
     */
    protected function parseDOMElement(IteratorAggregate $elements, Model $parent = null): void
    {
        // Since we have no control over the XML returned by myDATA,
        // it is possible to encounter node names within the XML that
        // are not handled by this project. In the event of an unhandled
        // unknown node model, rather than throwing an exception, it is
        // preferred to ignore the unhandled node entirely and allow the
        // application to proceed with the remaining elements.
        if ($parent === null) {
            return;
        }

        // Parse the child nodes
        foreach ($elements as $child) {
            $this->parseSimpleElement($child, $parent);
        }
    }

    protected function parseSimpleElement(DOMElement $element, Model $parent): void
    {
        $name = $element->localName;

        if (!$element->childElementCount) {
            $parent->set($name, $element->nodeValue);
            return;
        }

        $model = $this->createModel($parent, $name);
        $this->parseDOMElement($element->childNodes, $model);
        if ($parent instanceof IteratorAggregate) {
            $parent->push($name, $model);
        } else {
            $parent->set($name, $model);
        }
    }

    protected function createModel(Model $parent, string $name): mixed
    {
        $cast = $parent->getCast($name);
        return $cast ? new $cast() : null;
    }

    public function getDomDocument(): DOMDocument
    {
        return $this->document;
    }

    /**
     * @param  string  $xmlString
     * @return Model
     */
    abstract public function parseXml(string $xmlString): mixed;
}
