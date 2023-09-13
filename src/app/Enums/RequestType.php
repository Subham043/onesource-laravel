<?php

namespace App\Enums;

enum RequestType:string {
    case CALL_BACK = 'Call Back';
    case HOME_VISIT = 'Home Visit';
    case VISIT_OUR_CENTER = 'Visit Our Center';
    case CONNECT_ONLINE = 'Connect Online';
}
