<?php

namespace OxygenSuite\DigitalClient\Models;

use OxygenSuite\DigitalClient\Enums\ClientServiceType;
use OxygenSuite\DigitalClient\Traits\HasFactory;
use OxygenSuite\DigitalClient\Xml\CreateClientDocWriter;

class CreateDigitalClient extends Model
{
    use HasFactory;

    protected array $expectedOrder = [
        'idDcl',
        'clientServiceType',
        'creationDateTime',
        'entityVatNumber',
        'branch',
        'recurringService',
        'continuousService',
        'fromAgreedPeriodDate',
        'toAgreedPeriodDate',
        'mixedService',
        'customerVatNumber',
        'customerCountry',
        'transmissionFailure',
        'correlatedDclId',
        'comments',
        'useCase',
        'periodicity',
        'continuousLeaseService',
        'periodicityOther',
    ];

    public function getIdDcl(): ?string
    {
        return $this->get('idDcl');
    }

    public function setIdDcl(string $idDcl): static
    {
        return $this->set('idDcl', $idDcl);
    }

    public function getClientServiceType(): ClientServiceType|int|null
    {
        return $this->get('clientServiceType');
    }

    public function setClientServiceType(ClientServiceType|int $clientServiceType): static
    {
        return $this->set('clientServiceType', $clientServiceType);
    }

    public function getCreationDateTime(): ?string
    {
        return $this->get('creationDateTime');
    }

    public function setCreationDateTime(string $creationDateTime): static
    {
        return $this->set('creationDateTime', $creationDateTime);
    }

    public function getEntityVatNumber(): ?string
    {
        return $this->get('entityVatNumber');
    }

    public function setEntityVatNumber(string $entityVatNumber): static
    {
        return $this->set('entityVatNumber', $entityVatNumber);
    }

    public function getBranch(): ?int
    {
        return $this->get('branch');
    }

    public function setBranch(int $branch): static
    {
        return $this->set('branch', $branch);
    }

    public function getRecurringService(): ?bool
    {
        return $this->get('recurringService');
    }

    public function setRecurringService(bool $recurringService): static
    {
        return $this->set('recurringService', $recurringService);
    }

    public function getContinuousService(): ?bool
    {
        return $this->get('continuousService');
    }

    public function setContinuousService(bool $continuousService): static
    {
        return $this->set('continuousService', $continuousService);
    }

    public function getFromAgreedPeriodDate(): ?string
    {
        return $this->get('fromAgreedPeriodDate');
    }

    public function setFromAgreedPeriodDate(string $fromAgreedPeriodDate): static
    {
        return $this->set('fromAgreedPeriodDate', $fromAgreedPeriodDate);
    }

    public function getToAgreedPeriodDate(): ?string
    {
        return $this->get('toAgreedPeriodDate');
    }

    public function setToAgreedPeriodDate(string $toAgreedPeriodDate): static
    {
        return $this->set('toAgreedPeriodDate', $toAgreedPeriodDate);
    }

    public function getMixedService(): ?bool
    {
        return $this->get('mixedService');
    }

    public function setMixedService(bool $mixedService): static
    {
        return $this->set('mixedService', $mixedService);
    }

    public function getCustomerVatNumber(): ?string
    {
        return $this->get('customerVatNumber');
    }

    public function setCustomerVatNumber(string $customerVatNumber): static
    {
        return $this->set('customerVatNumber', $customerVatNumber);
    }

    public function getCustomerCountry(): ?string
    {
        return $this->get('customerCountry');
    }

    public function setCustomerCountry(string $customerCountry): static
    {
        return $this->set('customerCountry', $customerCountry);
    }

    public function getTransmissionFailure(): ?int
    {
        return $this->get('transmissionFailure');
    }

    public function setTransmissionFailure(int $transmissionFailure): static
    {
        return $this->set('transmissionFailure', $transmissionFailure);
    }

    public function getCorrelatedDclId(): ?string
    {
        return $this->get('correlatedDclId');
    }

    public function setCorrelatedDclId(string $correlatedDclId): static
    {
        return $this->set('correlatedDclId', $correlatedDclId);
    }

    public function getComments(): ?string
    {
        return $this->get('comments');
    }

    public function setComments(string $comments): static
    {
        return $this->set('comments', $comments);
    }

    public function getUseCase(): ?Service
    {
        $useCase = $this->get('useCase');

        if (! $useCase || ! is_array($useCase)) {
            return null;
        }

        return array_shift($useCase);
    }

    public function setUseCase(Service $useCase): static
    {
        return $this->set('useCase', [$useCase->name() => $useCase]);
    }

    public function getPeriodicity(): ?int
    {
        return $this->get('periodicity');
    }

    public function setPeriodicity(int $periodicity): static
    {
        return $this->set('periodicity', $periodicity);
    }

    public function getContinuousLeaseService(): ?bool
    {
        return $this->get('continuousLeaseService');
    }

    public function setContinuousLeaseService(bool $continuousLeaseService): static
    {
        return $this->set('continuousLeaseService', $continuousLeaseService);
    }

    public function getPeriodicityOther (): ?string
    {
        return $this->get('periodicityOther');
    }

    public function setPeriodicityOther (string $periodicityOther): static
    {
        return $this->set('periodicityOther', $periodicityOther);
    }

    public function toXml(bool $asNewDigitalClientDoc = false): string
    {
        $writer = new CreateClientDocWriter();
        $fullXml = $writer->asXML(new NewDigitalClientDoc($this));

        if ($asNewDigitalClientDoc) {
            return $fullXml;
        }

        $doc = $writer->getDomDocument();

        return $doc->saveXML($doc->getElementsByTagName('newDigitalClient')->item(0));
    }
}
