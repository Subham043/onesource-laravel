<?php

namespace App\Modules\Event\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Services\EventService;

class EventSingleCancelController extends Controller
{
    private $eventService;

    public function __construct(EventService $eventService)
    {
        $this->middleware('permission:edit events', ['only' => ['get','post']]);
        $this->eventService = $eventService;
    }

    public function get($id){
        $event = $this->eventService->getById($id);
        $event->is_active = !$event->is_active;
        $event->save();
        return redirect()->back()->with(['success_status' => 'Event Status Updated Successfully']);
    }
}
