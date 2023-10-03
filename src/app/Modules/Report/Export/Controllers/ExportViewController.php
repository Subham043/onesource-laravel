<?php

namespace App\Modules\Report\Export\Controllers;

use App\Http\Controllers\Controller;

class ExportViewController extends Controller
{
    public function get(){
        return view('reports.export')->with([
            'page_name' => 'Export'
        ]);
    }
}
