<?php

namespace App\Modules\Report\Conflict\Controllers;

use App\Http\Controllers\Controller;

class ConflictViewController extends Controller
{
    public function get(){
        return view('reports.conflict');
    }
}
