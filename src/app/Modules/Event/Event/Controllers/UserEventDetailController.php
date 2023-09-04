<?php

namespace App\Modules\Event\Event\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Event\Resources\UserEventCollection;
use App\Modules\Event\Event\Services\EventService;

class UserEventDetailController extends Controller
{
    private $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function get($slug){
        $event = $this->eventService->getBySlug($slug);
        return response()->json([
            'message' => "Event recieved successfully.",
            'event' => UserEventCollection::make($event),
        ], 200);
    }
}
