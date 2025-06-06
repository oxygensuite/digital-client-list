<?php

namespace OxygenSuite\DigitalClient\Models;

/**
 * Στις περιπτώσεις που ο χρήστης χρησιμοποιήσει κάποια μέθοδο υποβολής στοιχείων ή
 * ακύρωση (SendInvoices, SendIncomeClassification, SendExpensesClassification,
 * CancelInvoice) θα λαμβάνει ως απάντηση ένα αντικείμενο ResponseDoc σε xml μορφή. Το
 * αντικείμενο περιλαμβάνει μια λίστα από στοιχεία τύπου response, ένα για κάθε οντότητα
 * που υποβλήθηκε.
 *
 * @extends ModelArray<Response>
 */
class ResponseDoc extends ModelArray
{
    protected array $casts = [
        'response' => Response::class,
    ];

    public function __construct()
    {
        parent::__construct('response');
    }

    public function offsetGet(mixed $offset): Response
    {
        return $this->attributes['response'][$offset];
    }
}
