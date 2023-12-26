<?php

namespace App\Modules\Notification\Jobs;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Log;

class ScheduleNotificationJob
{
    public function __invoke(){
        Log::info('An informational message.');
    }
}
