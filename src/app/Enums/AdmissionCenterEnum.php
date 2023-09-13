<?php

namespace App\Enums;

enum AdmissionCenterEnum:string {
    case HEBBAL = 'Hebbal (PU)';
    case VIJAYNAGAR = 'Vijaynagar (PU)';
    case KENGERI = 'Kengeri (CBSE)';
    case UTTARAHALLI = 'Uttarahalli Road (PU)';
    case KANAKAPURA = 'Kanakpura Road(Residential Campus)';
    case LIVE_ONLINE_CLASSES = 'LIVE Online Classes';
}
