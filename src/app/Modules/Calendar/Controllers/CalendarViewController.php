<?php

namespace App\Modules\Calendar\Controllers;

use App\Http\Controllers\Controller;

class CalendarViewController extends Controller
{
    public function get(){
        return view('calendar.view')->with([
            'page_name' => 'Calendar'
        ]);
    }
}
