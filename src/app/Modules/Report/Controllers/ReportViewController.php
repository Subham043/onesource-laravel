<?php

namespace App\Modules\Report\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Document\Models\DocumentNotification;
use App\Modules\Event\Services\EventService;

class ReportViewController extends Controller
{
    private $eventService;

    public function __construct(EventService $eventService)
    {
        $this->middleware('permission:view reports', ['only' => ['get','post']]);
        $this->eventService = $eventService;
    }

    public function get(){
        $data = $this->eventService->allConflict();
        $filtered_count = $data->filter(function($item){
            return $item->writerEvents->count()>=2;
        })->count();
        return view('reports.view')->with([
            'page_name' => 'Report',
            'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get(),
            'conflict_count' => $filtered_count,
        ]);
    }
}
