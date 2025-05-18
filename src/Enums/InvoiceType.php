<?php

namespace OxygenSuite\DigitalClient\Enums;

enum InvoiceType: int
{
    /*
     * ΑΛΠ/ΑΠΥ
     */
    case RETAIL = 1;
    /*
     * ΤΙΜΟΛΟΓΙΟ
     */
    case INVOICE = 2;
    /*
     * ΑΛΠ/ΑΠΥ-ΦΗΜ
     */
    case RETAIL_FIM = 3;
}
