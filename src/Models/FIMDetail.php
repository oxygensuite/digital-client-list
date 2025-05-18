<?php

namespace OxygenSuite\DigitalClient\Models;

use OxygenSuite\DigitalClient\Traits\HasFactory;

class FIMDetail extends Model
{
    use HasFactory;

    protected array $expectedOrder = [
        'FIMNumber',
        'FIMAA',
        'FIMIssueDate',
        'FIMIssueTime',
    ];

    public function getFIMNumber(): ?string
    {
        return $this->get('FIMNumber');
    }

    public function setFIMNumber(string $FIMNumber): static
    {
        return $this->set('FIMNumber', $FIMNumber);
    }

    public function getFIMAA(): ?string
    {
        return $this->get('FIMAA');
    }

    public function setFIMAA(string $FIMAA): static
    {
        return $this->set('FIMAA', $FIMAA);
    }

    public function getFIMIssueDate(): ?string
    {
        return $this->get('FIMIssueDate');
    }

    public function setFIMIssueDate(string $FIMIssueDate): static
    {
        return $this->set('FIMIssueDate', $FIMIssueDate);
    }

    public function getFIMIssueTime(): ?string
    {
        return $this->get('FIMIssueTime');
    }

    public function setFIMIssueTime(string $FIMIssueTime): static
    {
        return $this->set('FIMIssueTime', $FIMIssueTime);
    }
}
