<?php

namespace App\Enums;

enum ScholarBranch:string {
    case VIJAYNAGAR_SCHOLAR = 'Vijayanagar (PU & CBSE)';
    case NPS_SCHOLAR = 'NPS Kengeri (CBSE)';
    case VSS_SCHOLAR = 'VSS School, Ullal (CBSE)';
    case VEDANTHA_SCHOLAR = 'Vedantha College, Vasanthapura (PU)';
    case VIJAYNAGAR_RESIDENTIAL = 'Vijayanagar (for both boys & girls)';
    case VEDANTHA_RESIDENTIAL = 'Vedantha College, Vasanthapura (for girls only)';
    case PARIVARTHANA_RESIDENTIAL = 'Parivarthana College, Mysore (for both boys & girls)';
}
