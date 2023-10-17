<?php

namespace App\Modules\Calendar\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Services\EventService;

class CalendarViewController extends Controller
{
    private $eventService;

    public function __construct(EventService $eventService)
    {
        $this->middleware('permission:view calendar', ['only' => ['get','post']]);
        $this->eventService = $eventService;
    }
    public function get(){
        $current_month_events = $this->eventService->all(true);
        return view('calendar.view')->with([
            'page_name' => 'Calendar',
            'current_month_events' => $current_month_events
        ]);
    }
}
