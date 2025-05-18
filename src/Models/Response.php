<?php

namespace OxygenSuite\DigitalClient\Models;

use OxygenSuite\DigitalClient\Traits\HasFactory;

class Response extends Model
{
    use HasFactory;

    protected array $casts = [
        'errors' => Errors::class,
    ];

    /**
     * @return int|null Αριθμός Σειράς Οντότητας εντός του υποβληθέντος xml
     */
    public function getIndex(): ?int
    {
        return $this->get('index');
    }

    public function setIndex(int $index): static
    {
        return $this->set('index', $index);
    }

    /**
     * <p>Καθορίζει το είδος της απάντησης (πετυχημένη ή αποτυχημένη διαδικασία).</p>
     *
     * <p>Σε περίπτωση επιτυχίας το πεδίο statusCode έχει τιμή Success και η απάντηση
     * περιλαμβάνει τις αντίστοιχες τιμές για τα πεδία newClientDclID, updatedClientDclID,
     * cancellationID και correlateId ανάλογα με την οντότητα που υποβλήθηκε.</p>
     *
     * <p>Σε περίπτωση αποτυχίας το πεδίο statusCode έχει τιμή αντίστοιχη του είδους του
     * σφάλματος και η απάντηση περιλαμβάνει μια λίστα στοιχείων σφάλματος τύπου
     * ErrorType για κάθε οντότητα που η υποβολή της απέτυχε. Όλα τα στοιχεία σφάλματος
     * ανά οντότητα είναι υποχρεωτικά της ίδιας κατηγορίας που χαρακτηρίζει την απάντηση.</p>
     *
     * <ul>Πιθανές τιμές
     * <li>Success</li>
     * <li>ValidationError</li>
     * <li>TechnicalError</li>
     * <li>XMLSyntaxError</li>
     * </ul>
     * @return string|null Κωδικός Αποτελέσματος
     */
    public function getStatusCode(): ?string
    {
        return $this->get('statusCode');
    }

    public function setStatusCode(string $statusCode): static
    {
        return $this->set('statusCode', $statusCode);
    }

    /**
     * Επιστρέφει μόνο στην περίπτωση που η υποβολή αφορούσε νέα καταχώρηση.
     *
     * @return string|null Μοναδικός Αριθμός Ψηφιακού Πελατολογίου
     */
    public function getNewClientDclId(): ?string
    {
        return $this->get('newClientDclID');
    }

    public function setNewClientDclId(string $newClientDclId): static
    {
        return $this->set('newClientDclID', $newClientDclId);
    }

    /**
     * Επιστρέφει μόνο στην περίπτωση που η υποβολή αφορούσε ανανέωση καταχώρησης.
     *
     * @return string|null Μοναδικός Αριθμός Ενημέρωσης / Ολοκλήρωσης Ψηφιακού Πελατολογίου
     */
    public function getUpdatedClientDclId(): ?string
    {
        return $this->get('updatedClientDclID');
    }

    public function setUpdatedClientDclId(string $updatedClientDclId): static
    {
        return $this->set('updatedClientDclID', $updatedClientDclId);
    }

    /**
     * Επιστρέφει μόνο στην περίπτωση που η υποβολή αφορούσε ακύρωση καταχώρησης.
     *
     * @return string|null Μοναδικός Αριθμός Ακύρωσης
     */
    public function getCancellationId(): ?string
    {
        return $this->get('cancellationID');
    }

    public function setCancellationId(?string $cancellationId): static
    {
        return $this->set('cancellationId', $cancellationId);
    }

    /**
     *
     * @return string|null Μοναδικός Αριθμός Ενημέρωσης / Συσχέτισης Ψηφιακού Πελατολογίου
     */
    public function getClientCorrelationId(): ?string
    {
        return $this->get('clientCorrelationID');
    }

    public function setClientCorrelationId(string $clientCorrelationId): static
    {
        return $this->set('clientCorrelationID', $clientCorrelationId);
    }

    public function hasErrors(): bool
    {
        return !is_null($this->getErrors()) && count($this->getErrors()) > 0;
    }

    /**
     * @return Errors|null Λίστα Σφαλμάτων
     */
    public function getErrors(): ?Errors
    {
        return $this->get('errors');
    }

    public function isSuccessful(): bool
    {
        return $this->getStatusCode() === 'Success';
    }
}
