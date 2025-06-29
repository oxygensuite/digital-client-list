<?php

namespace OxygenSuite\DigitalClient\Enums;

enum ClientServiceType: int
{
    /*
     * Ενοικίαση
     */
    case RENTAL = 1;
    /*
     * Πάρκινγκ / Πλυντήρια
     */
    case PARKING_CAR_WASH = 2;
    /*
     * Συνεργεία
     */
    case WORKSHOP = 3;
}
