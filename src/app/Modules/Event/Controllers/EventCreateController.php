<?php

namespace App\Modules\Event\Controllers;

use App\Http\Controllers\Controller;

class EventCreateController extends Controller
{
    public function get(){
        return view('events.add')->with([
            'page_name' => 'Event'
        ]);
    }
}
