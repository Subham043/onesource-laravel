<?php

namespace App\Modules\Report\Conflict\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Document\Models\DocumentNotification;
use App\Modules\Event\Services\EventService;

class ConflictViewController extends Controller
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
        return view('reports.conflict')->with([
            'page_name' => 'Conflict',
            'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get(),
            'data' => $filtered,
        ]);
    }
}
