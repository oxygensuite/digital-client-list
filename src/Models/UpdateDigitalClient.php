<?php

namespace OxygenSuite\DigitalClient\Models;

use OxygenSuite\DigitalClient\Enums\ClientServiceType;
use OxygenSuite\DigitalClient\Enums\InvoiceType;
use OxygenSuite\DigitalClient\Enums\OffSiteProvidedServiceType;
use OxygenSuite\DigitalClient\Enums\ProvidedCategoryServiceType;
use OxygenSuite\DigitalClient\Enums\ReasonNonIssueType;
use OxygenSuite\DigitalClient\Traits\HasFactory;
use OxygenSuite\DigitalClient\Xml\UpdateClientDocWriter;

class UpdateDigitalClient extends Model
{
    use HasFactory;

    protected array $expectedOrder = [
        'updateUniqueId',
        'initialDclId',
        'clientServiceType',
        'entryCompletion',
        'nonIssueInvoice',
        'amount',
        'completionDateTime',
        'isDiffVehReturnLocation',
        'vehicleReturnLocation',
        'providedServiceCategory',
        'providedServiceCategoryOther',
        'invoiceKind',
        'offSiteProvidedService',
        'exitDateTime',
        'entityVatNumber',
        'cooperatingVatNumber',
        'otherBranch',
        'reasonNonIssueType',
        'comments',
        'invoiceCounterparty',
        'invoiceCounterpartyCountry',
    ];

    public function getUpdateUniqueId(): ?string
    {
        return $this->get('updateUniqueId');
    }

    public function setUpdateUniqueId(string $updateUniqueId): static
    {
        return $this->set('updateUniqueId', $updateUniqueId);
    }

    public function getInitialDclId(): ?string
    {
        return $this->get('initialDclId');
    }

    public function setInitialDclId(string $initialDclId): static
    {
        return $this->set('initialDclId', $initialDclId);
    }

    public function getClientServiceType(): ClientServiceType|string|null
    {
        return $this->get('clientServiceType');
    }

    public function setClientServiceType(ClientServiceType|string $clientServiceType): static
    {
        return $this->set('clientServiceType', $clientServiceType);
    }

    public function getEntryCompletion(): ?bool
    {
        return $this->get('entryCompletion');
    }

    public function setEntryCompletion(bool $entryCompletion): static
    {
        return $this->set('entryCompletion', $entryCompletion);
    }

    public function getNonIssueInvoice(): ?bool
    {
        return $this->get('nonIssueInvoice');
    }

    public function setNonIssueInvoice(bool $nonIssueInvoice): static
    {
        return $this->set('nonIssueInvoice', $nonIssueInvoice);
    }

    public function getAmount(): ?float
    {
        return $this->get('amount');
    }

    public function setAmount(float $amount): static
    {
        return $this->set('amount', $amount);
    }

    public function getCompletionDateTime(): ?string
    {
        return $this->get('completionDateTime');
    }

    public function setCompletionDateTime(string $completionDateTime): static
    {
        return $this->set('completionDateTime', $completionDateTime);
    }

    public function getIsDiffVehReturnLocation(): ?bool
    {
        return $this->get('isDiffVehReturnLocation');
    }

    public function setIsDiffVehReturnLocation(bool $isDiffVehReturnLocation): static
    {
        return $this->set('isDiffVehReturnLocation', $isDiffVehReturnLocation);
    }

    public function getVehicleReturnLocation(): ?string
    {
        return $this->get('vehicleReturnLocation');
    }

    public function setVehicleReturnLocation(string $vehicleReturnLocation): static
    {
        return $this->set('vehicleReturnLocation', $vehicleReturnLocation);
    }

    public function getProvidedServiceCategory(): ProvidedCategoryServiceType|int|null
    {
        return $this->get('providedServiceCategory');
    }

    public function setProvidedServiceCategory(ProvidedCategoryServiceType|int $providedServiceCategory): static
    {
        return $this->set('providedServiceCategory', $providedServiceCategory);
    }

    public function getProvidedServiceCategoryOther(): ?string
    {
        return $this->get('providedServiceCategoryOther');
    }

    public function setProvidedServiceCategoryOther(string $providedServiceCategoryOther): static
    {
        return $this->set('providedServiceCategoryOther', $providedServiceCategoryOther);
    }

    public function getInvoiceKind(): InvoiceType|int|null
    {
        return $this->get('invoiceKind');
    }

    public function setInvoiceKind(InvoiceType|int $invoiceKind): static
    {
        return $this->set('invoiceKind', $invoiceKind);
    }

    public function getOffSiteProvidedService(): OffSiteProvidedServiceType|int|null
    {
        return $this->get('offSiteProvidedService');
    }

    public function setOffSiteProvidedService(OffSiteProvidedServiceType|int $offSiteProvidedService): static
    {
        return $this->set('offSiteProvidedService', $offSiteProvidedService);
    }

    public function getExitDateTime(): ?string
    {
        return $this->get('exitDateTime');
    }

    public function setExitDateTime(string $exitDateTime): static
    {
        return $this->set('exitDateTime', $exitDateTime);
    }

    public function getEntityVatNumber(): ?string
    {
        return $this->get('entityVatNumber');
    }

    public function setEntityVatNumber(string $entityVatNumber): static
    {
        return $this->set('entityVatNumber', $entityVatNumber);
    }

    public function getCooperatingVatNumber(): ?string
    {
        return $this->get('cooperatingVatNumber');
    }

    public function setCooperatingVatNumber(string $cooperatingVatNumber): static
    {
        return $this->set('cooperatingVatNumber', $cooperatingVatNumber);
    }

    public function getOtherBranch(): ?int
    {
        return $this->get('otherBranch');
    }

    public function setOtherBranch(int $otherBranch): static
    {
        return $this->set('otherBranch', $otherBranch);
    }

    public function getReasonNonIssueType(): ReasonNonIssueType|int|null
    {
        return $this->get('reasonNonIssueType');
    }

    public function setReasonNonIssueType(ReasonNonIssueType|int $reasonNonIssueType): static
    {
        return $this->set('reasonNonIssueType', $reasonNonIssueType);
    }

    public function getComments(): ?string
    {
        return $this->get('comments');
    }

    public function setComments(string $comments): static
    {
        return $this->set('comments', $comments);
    }

    public function getInvoiceCounterparty(): ?string
    {
        return $this->get('invoiceCounterparty');
    }

    public function setInvoiceCounterparty(string $invoiceCounterparty): static
    {
        return $this->set('invoiceCounterparty', $invoiceCounterparty);
    }

    public function getInvoiceCounterpartyCountry(): ?string
    {
        return $this->get('invoiceCounterpartyCountry');
    }

    public function setInvoiceCounterpartyCountry(string $invoiceCounterpartyCountry): static
    {
        return $this->set('invoiceCounterpartyCountry', $invoiceCounterpartyCountry);
    }

    public function toXml(bool $asUpdateClientDoc = false): string
    {
        $writer = new UpdateClientDocWriter();
        $fullXml = $writer->asXML(new UpdateClientDoc($this));

        if ($asUpdateClientDoc) {
            return $fullXml;
        }

        $doc = $writer->getDomDocument();

        return $doc->saveXML($doc->getElementsByTagName('updateClient')->item(0));
    }
}
