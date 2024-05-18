<?php

namespace App\Modules\Report\Export\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Services\EventService;
use Illuminate\Http\Request;

class ExportPrintController extends Controller
{
    private $eventService;

    public function __construct(EventService $eventService)
    {
        $this->middleware('permission:view exports', ['only' => ['get','post']]);
        $this->eventService = $eventService;
    }
    public function get(Request $request){
        $data = $this->eventService->paginateReport($request->total ?? 10);
        return view('print.print')->with([
            'print' => view('print.export')->with([
                'data' => $data,
            ]),
        ]);
    }
}