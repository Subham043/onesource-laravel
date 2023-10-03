<?php

namespace App\Modules\User\Controllers;

use App\Http\Controllers\Controller;

class UserViewController extends Controller
{

    public function get($id){
        return view('users.view')->with([
            'page_name' => 'User'
        ]);
    }
}
