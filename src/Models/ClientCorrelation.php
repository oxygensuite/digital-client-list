<?php

namespace OxygenSuite\DigitalClient\Models;

use OxygenSuite\DigitalClient\Traits\HasFactory;
use OxygenSuite\DigitalClient\Xml\ClientCorrelationDocWriter;

class ClientCorrelation extends Model
{
    use HasFactory;

    protected array $expectedOrder = [
        'correlateId',
        'entityVatNumber',
        'mark',
        'FIM',
        'correlatedDCLids',
    ];

    public function getCorrelateId(): ?string
    {
        return $this->get('correlateId');
    }

    public function setCorrelateId(string $correlateId): static
    {
        return $this->set('correlateId', $correlateId);
    }

    public function getEntityVatNumber(): ?string
    {
        return $this->get('entityVatNumber');
    }

    public function setEntityVatNumber(string $entityVatNumber): static
    {
        return $this->set('entityVatNumber', $entityVatNumber);
    }

    public function getMark(): ?string
    {
        return $this->get('mark');
    }

    public function setMark(string $mark): static
    {
        return $this->set('mark', $mark);
    }

    public function getFIM(): ?FIMDetail
    {
        return $this->get('FIM');
    }

    public function setFIM(FIMDetail $FIM): static
    {
        return $this->set('FIM', $FIM);
    }

    public function getCorrelatedDCLids(): ?array
    {
        return $this->get('correlatedDCLids');
    }

    public function setCorrelatedDCLids(array $correlatedDCLids): static
    {
        return $this->set('correlatedDCLids', $correlatedDCLids);
    }

    public function addCorrelatedDCLid(string $correlatedDCLid): static
    {
        return $this->push('correlatedDCLids', $correlatedDCLid);
    }
    public function toXml(bool $asClientCorrelationsDoc = false): string
    {
        $writer = new ClientCorrelationDocWriter();
        $fullXml = $writer->asXML(new ClientCorrelationDoc($this));

        if ($asClientCorrelationsDoc) {
            return $fullXml;
        }

        $doc = $writer->getDomDocument();

        return $doc->saveXML($doc->getElementsByTagName('clientCorrelation')->item(0));
    }
}
