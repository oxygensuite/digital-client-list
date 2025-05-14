<?php

namespace OxygenSuite\OxygenDcl\Enums;

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
