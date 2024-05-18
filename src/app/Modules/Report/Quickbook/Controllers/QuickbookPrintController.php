<?php

namespace App\Modules\Report\Quickbook\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Services\EventService;
use Illuminate\Http\Request;

class QuickbookPrintController extends Controller
{
    private $eventService;

    public function __construct(EventService $eventService)
    {
        $this->middleware('permission:view quickbook', ['only' => ['get','post']]);
        $this->eventService = $eventService;
    }

    public function get(Request $request){
        $data = $this->eventService->paginateQuickbookReport($request->total ?? 10);
        return view('print.print')->with([
            'print' => view('print.quickbook')->with([
                'data' => $data,
            ]),
        ]);
    }
}