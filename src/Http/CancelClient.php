<?php

namespace OxygenSuite\DigitalClient\Http;

use OxygenSuite\DigitalClient\Exceptions\DCLException;
use OxygenSuite\DigitalClient\Http\Traits\HasResponseDom;
use OxygenSuite\DigitalClient\Models\ResponseDoc;
use OxygenSuite\DigitalClient\Xml\ResponseDocReader;

class CancelClient extends DCLRequest
{
    use HasResponseDom;

    /**
     * <ol>
     * <li>Στην περίπτωση που τα αποτελέσματα αναζήτησης ξεπερνούν σε μέγεθος το μέγιστο
     * επιτρεπτό όριο ο χρήστης θα τα λάβει τμηματικά. Το πεδίο continuationToken θα
     * εμπεριέχεται σε κάθε τμήμα των αποτελεσμάτων και θα χρησιμοποιείται ως
     * παράμετρος στην κλήση για την λήψη του επόμενου τμήματος αποτελεσμάτων</li>
     *
     * <li>Αν η παράμετρος entityVatNumber έχει τιμή, η αναζήτηση θα πραγματοποιηθεί για
     * αυτόν τον ΑΦΜ, αλλιώς για τον ΑΦΜ του χρήστη που καλεί την μέθοδο</li>
     *
     * <li>Όταν μια προαιρετική παράμετρος δεν εισάγεται, η αναζήτηση πραγματοποιείται για
     * όλες τις πιθανές τιμές που θα μπορούσε να έχει αυτό το πεδίο</li>
     *
     * <li>Οι εγγραφές Ψηφιακού Πελατολογίου που επιστρέφονται κατά την κλήση, περιέχουν
     * πεδία με ημερομηνίες, τα οποία είναι σε ώρα Ελλάδος (Europe/Athens Time Zone)</li>
     * </ol>
     *
     * @param string $dclid Αναγνωριστικό Εγγραφής Ψηφιακού Πελατολογίου.
     * @param string|null $entityVatNumber ΑΦΜ οντότητας
     * @return ResponseDoc
     * @throws DCLException
     */
    public function handle(string $dclid = '', string $entityVatNumber = null): ResponseDoc
    {
        $query = compact('dclid', 'entityVatNumber');

        // Get the response XML
        $responseXML = $this->post($query);

        // Parse the response XML
        $reader = new ResponseDocReader();
        $responseDoc = $reader->parseXML($responseXML);

        $this->responseDom = $reader->getDomDocument();

        return $responseDoc;
    }
}
