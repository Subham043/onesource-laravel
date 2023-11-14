<?php

namespace App\Modules\Report\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Document\Models\DocumentNotification;

class ReportViewController extends Controller
{
    public function get(){
        return view('reports.view')->with([
            'page_name' => 'Report',
            'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get()
        ]);
    }
}
