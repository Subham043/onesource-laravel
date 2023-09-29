<?php

namespace App\Modules\Report\Quickbook\Controllers;

use App\Http\Controllers\Controller;

class QuickbookViewController extends Controller
{
    public function get(){
        return view('reports.quickbook');
    }
}
