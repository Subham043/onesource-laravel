<?php

namespace App\Modules\Dashboard\Controllers;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function get(){
        return view('dashboard');
    }
}
