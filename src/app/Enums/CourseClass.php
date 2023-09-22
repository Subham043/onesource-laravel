<?php

namespace App\Enums;

enum CourseClass:string {
    case NOT_PUC = 'School (STD VIII to X)';
    case PUC = 'Senior Secondary (XI, XII, PU)';
    case ONLINE = 'Online';
}
