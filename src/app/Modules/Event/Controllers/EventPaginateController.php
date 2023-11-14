<?php

namespace App\Modules\Event\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Document\Models\DocumentNotification;
use App\Modules\Event\Services\EventService;
use Illuminate\Http\Request;

class EventPaginateController extends Controller
{
    private $eventService;

    public function __construct(EventService $eventService)
    {
        $this->middleware('permission:list events', ['only' => ['get','post']]);
        $this->eventService = $eventService;
    }

    public function get(Request $request){
        $data = $this->eventService->paginate($request->total ?? 10);
        return view('events.list', compact(['data']))->with([
            'page_name' => 'Event',
            'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get()
        ])
        ->with('search', $request->query('filter')['search'] ?? '');
    }

}
