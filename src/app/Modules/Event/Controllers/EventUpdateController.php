<?php

namespace App\Modules\Event\Controllers;

use App\Http\Controllers\Controller;

class EventUpdateController extends Controller
{
    public function get($id){
        return view('events.edit');
    }
}
