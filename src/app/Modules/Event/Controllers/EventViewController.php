<?php

namespace App\Modules\Event\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Document\Models\DocumentNotification;
use App\Modules\Event\Services\EventService;
use App\Modules\Notification\Services\NotificationService;

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
            'page_name' => 'Event',
            'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get()
        ]);
    }

    public function notify($id){
        $event = $this->eventService->getById($id);
        (new NotificationService)->sendEventNotification($event->id);
        return redirect()->back()->with('success_status', 'Notification sent successfully.');
    }
}