<?php

namespace App\Modules\Calendar\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Services\EventService;

class CalendarPrintController extends Controller
{
    private $eventService;

    public function __construct(EventService $eventService)
    {
        $this->middleware('permission:view calendar', ['only' => ['get','post']]);
        $this->eventService = $eventService;
    }
    public function get(){
        $events = $this->eventService->all(false);
        return view('print.print')->with([
            'print' => view('print.calendar', compact('events'))
        ]);
    }
}