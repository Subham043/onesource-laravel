<?php

namespace App\Modules\Report\Conflict\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Services\EventService;

class ConflictPrintController extends Controller
{
    private $eventService;

    public function __construct(EventService $eventService)
    {
        $this->middleware('permission:view conflicts', ['only' => ['get','post']]);
        $this->eventService = $eventService;
    }

    public function get(){
        $data = $this->eventService->allConflict();
        $filtered = $data->filter(function($item){
            return $item->writerEvents->count()>=2;
        });
        return view('print.print')->with([
            'print' => view('print.conflict')->with([
                'data' => $filtered,
            ]),
        ]);
    }
}