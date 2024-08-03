<?php

namespace App\Modules\Report\Conflict\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Report\Conflict\Services\ConflictService;

class ConflictPrintController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view conflicts', ['only' => ['get','post']]);
    }

    public function get(){
        $clashingEvents = (new ConflictService)->getConflicts();
        return view('print.print')->with([
            'print' => view('print.conflict')->with([
                'data' => $clashingEvents,
            ]),
        ]);
    }
}