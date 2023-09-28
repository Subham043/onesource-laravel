<?php

namespace App\Modules\Event\Event\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Event\Resources\UserEventCollection;
use App\Modules\Event\Event\Services\EventService;

class UserEventAllController extends Controller
{
    private $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function get(){
        $data = $this->eventService->all_main();
        return response()->json([
            'message' => "Events recieved successfully.",
            'events' => UserEventCollection::collection($data),
        ], 200);
    }

}
