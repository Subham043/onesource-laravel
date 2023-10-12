<?php

namespace App\Enums;

enum RecurringType:string {
    case DAILY = 'Daily';
    case WEEKLY = 'Weekly';
    case MONTHLY = 'Monthly';
    case YEARLY = 'Yearly';
    case EVERY = 'Every';
    case EVERYWEEKDAY = 'Every Week Day';
}
