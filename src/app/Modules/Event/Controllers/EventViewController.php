<?php

namespace App\Modules\Event\Controllers;

use App\Http\Controllers\Controller;

class EventViewController extends Controller
{
    public function get($id){
        return view('events.view');
    }
}
