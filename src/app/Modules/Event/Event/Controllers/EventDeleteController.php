<?php

namespace App\Modules\Event\Event\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Event\Services\EventService;

class EventDeleteController extends Controller
{
    private $eventService;

    public function __construct(EventService $eventService)
    {
        $this->middleware('permission:delete events', ['only' => ['get']]);
        $this->eventService = $eventService;
    }

    public function get($id){
        $event = $this->eventService->getById($id);

        try {
            //code...
            $this->eventService->delete(
                $event
            );
            return redirect()->back()->with('success_status', 'Event deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
