<?php

namespace App\Modules\Event\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Services\EventService;

class EventViewController extends Controller
{
    private $eventService;

    public function __construct(EventService $eventService)
    {
        $this->middleware('permission:view events', ['only' => ['get','post']]);
        $this->eventService = $eventService;
    }

    public function get($id){
        $event = $this->eventService->getById($id);
        return view('events.view', compact(['event']))->with([
            'page_name' => 'Event'
        ]);
    }
}
