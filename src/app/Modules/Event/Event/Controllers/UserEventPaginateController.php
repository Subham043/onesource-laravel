<?php

namespace App\Modules\Event\Event\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Event\Resources\UserEventCollection;
use App\Modules\Event\Event\Services\EventService;
use Illuminate\Http\Request;

class UserEventPaginateController extends Controller
{
    private $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function get(Request $request){
        $data = $this->eventService->paginateMain($request->total ?? 10);
        return UserEventCollection::collection($data);
    }

}
