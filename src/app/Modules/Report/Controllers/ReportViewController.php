<?php

namespace App\Modules\Report\Controllers;

use App\Http\Controllers\Controller;

class ReportViewController extends Controller
{
    public function get(){
        return view('reports.view')->with([
            'page_name' => 'Report'
        ]);
    }
}
