<?php

namespace App\Enums;

enum Timezone:string {
    case Honolulu = 'Pacific/Honolulu GMT-10:00';
    case Anchorage = 'America/Anchorage GMT-9:00';
    case Los_Angeles = 'America/Los_Angeles GMT-8:00';
    case Boise = 'America/Boise GMT-7:00';
    case Denver = 'America/Denver GMT-7:00';
    case Phoenix = 'America/Phoenix GMT-7:00';
    case Chicago = 'America/Chicago GMT-6:00';
    case Detroit = 'America/Detroit GMT-5:00';
    case New_York = 'America/New_York GMT-5:00';
}
