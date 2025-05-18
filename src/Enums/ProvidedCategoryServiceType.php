<?php

namespace OxygenSuite\DigitalClient\Enums;

enum ProvidedCategoryServiceType: int
{
    /*
     * Εργασία με χρήση ανταλλακτικών (Συνεργεία)
     */
    case WORK_WITH_PARTS = 1;
    /*
     * Εργασία με χρήση ανταλλακτικών πελάτη (Συνεργεία)
     */
    case WORK_WITH_CUSTOMER_PARTS = 2;
    /*
     * Εργασία χωρίς χρήση ανταλλακτικών (Συνεργεία)
     */
    case WORK_WITHOUT_PARTS = 3;
    /*
     * Δωρεάν υπηρεσία (Ενοικίαση, Πάρκινγκ/ Πλυντήρια, Συνεργεία)
     */
    case FREE_SERVICE = 4;
    /*
     * Λοιπά (Πάρκινγκ/ Πλυντήρια, Συνεργεία)
     */
    case OTHER = 5;
    /*
     * Αποζημίωση Παροχής Εγγύησης
     */
    case WARRANTY_COMPENSATION = 6;
    /*
     * Υπηρεσία Βάσει Τιμοκαταλόγου (Πάρκινγκ/ Πλυντήρια)
     */
    case SERVICE_BASED_ON_PRICE_LIST = 7;
    /*
     * Υπηρεσία Βάση Συμφωνίας (Πάρκινγκ/ Πλυντήρια)
     */
    case SERVICE_BASED_ON_AGREEMENT = 8;
    /*
     * Ιδιόχρηση (Ενοικίαση, Πάρκινγκ/ Πλυντήρια, Συνεργεία)
     */
    case OWN_USE = 9;


}
