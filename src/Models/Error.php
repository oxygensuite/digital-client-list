<?php

namespace OxygenSuite\OxygenDcl\Models;

class Error extends Model
{
    /**
     * @return string|null Μήνυμα Σφάλματος
     */
    public function getMessage(): ?string
    {
        return $this->get('message');
    }

    /**
     * @return string|null Κωδικός Σφάλματος
     */
    public function getCode(): ?string
    {
        return $this->get('code');
    }
}
