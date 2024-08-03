<?php

namespace App\Modules\Report\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Document\Models\DocumentNotification;
use App\Modules\Report\Conflict\Services\ConflictService;

class ReportViewController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view reports', ['only' => ['get','post']]);
    }

    public function get(){
        return view('reports.view')->with([
            'page_name' => 'Report',
            'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get(),
            'conflict_count' => count((new ConflictService)->getConflicts()),
        ]);
    }
}
