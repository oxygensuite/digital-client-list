<?php

namespace OxygenSuite\DigitalClient\Enums;

/*
 * Αιτιολογία Μη έκδοσης Παραστατικού
 */

enum ReasonNonIssueType: int
{
    /*
     * Δωρεάν Υπηρεσία (Ενοικίαση, Πάρκινγκ/Πλυντήρια, Συνεργεία)
     */
    case FREE_SERVICE = 1;
    /*
     * Ιδιόχρηση (Ενοικίαση, Πάρκινγκ/Πλυντήρια, Συνεργεία)
     */
    case OWN_USE = 2;
    /*
     * Αποζημίωση Παροχής Εγγύησης
     */
    case WARRANTY_COMPENSATION = 3;
}
