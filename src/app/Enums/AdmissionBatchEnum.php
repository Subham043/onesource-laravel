<?php

namespace App\Enums;

enum AdmissionBatchEnum:string {
    case BOARD_BATCH = 'Board Batch - CBSE/ICSE/STATE';
    case FOUNDATION_PROGRAM = 'Foundation Program';
    case BOARD_FOUNDATION = 'Board + Foundation Program';
    case DAY_SCHOLAR = '2-Years Full-Time Super 30 Classroom Program(Day Scholar)';
    case RESIDENTIAL = '2-Year Full-Time Super 30 Classroom Program (Residential)';
    case JEE = 'JEE Evening Batch';
    case NEET = 'NEET Evening Batch';
    case KVPY = 'KVPY Weekend Batch';
    case JEE_NEET_KVPY = 'JEE+NEET+KVPY (7 Days a week)';
}
