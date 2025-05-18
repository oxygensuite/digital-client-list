<?php

namespace OxygenSuite\DigitalClient\Models;

/**
 * <p>Στην περίπτωση που τα αποτελέσματα αναζήτησης ξεπερνούν σε μέγεθος το μέγιστο
 * επιτρεπτό όριο ο χρήστης θα τα λάβει τμηματικά. Το πεδίο continuationToken θα
 * εμπεριέχεται σε κάθε τμήμα των αποτελεσμάτων και θα χρησιμοποιείται ως
 * παράμετρος στην κλήση για τη λήψη του επόμενου τμήματος αποτελεσμάτων</p>
 *
 * <p>Εφόσον αποδοθεί τιμή στην παράμετρο maxdclid, θα επιστραφούν όσες εγγραφές
 * έχουν dclid μικρότερο ή ίσο αυτή της τιμής</p>
 */
class RequestedDoc extends Model
{
    protected array $casts = [
        'clientsDoc' => ClientsDoc::class,
        'updateclientRequestsDoc' => UpdateClientRequestsDoc::class,
        'clientcorrelationsRequestsDoc' => ClientCorrelationsRequestsDoc::class,
        'cancelClientRequestsDoc' => CancelClientRequestsDoc::class,
    ];

    /**
     * @return string|null Στοιχείο για την τμηματική λήψη αποτελεσμάτων
     */
    public function getContinuationToken(): ?string
    {
        return $this->get('continuationToken');
    }

    public function getEntityVatNumber(): ?string
    {
        return $this->get('entityVatNumber');
    }

    public function getClientsDoc(): ?ClientsDoc
    {
        return $this->get('clientsDoc');
    }

    public function getUpdateClientRequestsDoc(): ?UpdateClientRequestsDoc
    {
        return $this->get('updateclientRequestsDoc');
    }

    public function getClientCorrelationsRequestsDoc(): ?ClientCorrelationsRequestsDoc
    {
        return $this->get('clientcorrelationsRequestsDoc');
    }

    public function getCancelClientRequestsDoc(): ?CancelClientRequestsDoc
    {
        return $this->get('cancelClientRequestsDoc');
    }
}
