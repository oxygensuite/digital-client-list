<?php

namespace OxygenSuite\DigitalClient\Models;

class CancelDigitalClient extends Model
{
    public function getDclid(): ?string
    {
        return $this->get('dclid');
    }

    public function getEvn(): ?string
    {
        return $this->get('env');
    }

    public function getCancellationID(): ?string
    {
        return $this->get('cancellationID');
    }

    public function getCancellationDate(): ?string
    {
        return $this->get('cancellationDate');
    }


}
