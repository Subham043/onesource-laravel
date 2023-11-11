<?php

namespace App\Modules\Event\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Services\EventService;

class EventSinglePrepController extends Controller
{
    private $eventService;

    public function __construct(EventService $eventService)
    {
        $this->middleware('permission:edit events', ['only' => ['get','post']]);
        $this->eventService = $eventService;
    }

    public function get($id){
        $event = $this->eventService->getById($id);
        $event->is_prep_ready = !$event->is_prep_ready;
        $event->save();
        return redirect()->back()->with(['success_status' => 'Event Prep Updated Successfully']);
    }
}
