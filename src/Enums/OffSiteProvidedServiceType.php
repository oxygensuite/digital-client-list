<?php

namespace OxygenSuite\DigitalClient\Enums;

/*
 * Παροχή Υπηρεσιών εκτός Εγκατάστασης
 */

enum OffSiteProvidedServiceType: int
{
    /*
     * Μετακίνηση σε συνεργαζόμενη οντότητα
     */
    case COLLABORATING_ENTITY = 1;
    /*
     * Μετακίνηση σε εγκατάσταση εντός της ίδιας οντότητας
     */
    case SAME_ENTITY = 2;
}
