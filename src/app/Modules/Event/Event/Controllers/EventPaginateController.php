<?php

namespace App\Modules\Event\Event\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Event\Services\EventService;
use Illuminate\Http\Request;

class EventPaginateController extends Controller
{
    private $eventService;

    public function __construct(EventService $eventService)
    {
        $this->middleware('permission:list events', ['only' => ['get']]);
        $this->eventService = $eventService;
    }

    public function get(Request $request){
        $data = $this->eventService->paginate($request->total ?? 10);
        return view('admin.pages.event.event.paginate', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
