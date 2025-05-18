<?php

namespace OxygenSuite\DigitalClient\Enums;

enum VehicleMovementPurposeType: int
{
    /**
     * Ενοικίαση
     */
    case RENTING = 1;

    /**
     * Ιδιόχρηση
     */
    case SELF_USE = 2;

    /**
     * Δωρεάν Υπηρεσία
     */
    case FREE_SERVICE = 3;
}
