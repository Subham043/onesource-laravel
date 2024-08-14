<?php

namespace App\Modules\Report\Conflict\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Document\Models\DocumentNotification;
use App\Modules\Report\Conflict\Services\ConflictService;

class ConflictViewController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view conflicts', ['only' => ['get','post']]);
    }

    public function get(){

        $clashingEvents = (new ConflictService)->getConflicts();
        return view('reports.conflict')->with([
            'page_name' => 'Conflict',
            'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get(),
            'data' => $clashingEvents,
        ]);
    }
}
