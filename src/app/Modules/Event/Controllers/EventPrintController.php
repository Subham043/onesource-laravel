<?php

namespace App\Modules\Event\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Services\EventService;
use Illuminate\Http\Request;

class EventPrintController extends Controller
{
    private $eventService;

    public function __construct(EventService $eventService)
    {
        $this->middleware('permission:list events', ['only' => ['get','post']]);
        $this->eventService = $eventService;
    }

    public function get(Request $request){
        $data = $this->eventService->paginate($request->total ?? 10);
        return view('print.print')->with([
            'print' => view('print.event')->with([
                'data' => $data,
            ]),
        ]);
    }

}