<?php

namespace App\Modules\Dashboard\Controllers;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function get(){
        if(auth()->user()->current_role=='Super Admin'){
            return redirect(route('customer.paginate.get'));
        }
        return view('dashboard')->with([
            'page_name' => 'Dashboard'
        ]);
    }
}
