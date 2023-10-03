<?php

namespace App\Modules\Event\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventPaginateController extends Controller
{
    public function get(Request $request){
        return view('events.list')->with([
            'page_name' => 'Event'
        ]);
    }

}
