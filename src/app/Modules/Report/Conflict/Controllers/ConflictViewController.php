<?php

namespace App\Modules\Report\Conflict\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Document\Models\DocumentNotification;

class ConflictViewController extends Controller
{
    public function get(){
        return view('reports.conflict')->with([
            'page_name' => 'Conflict',
            'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get()
        ]);
    }
}
