<?php

namespace App\Modules\Authentication\Controllers;

use App\Http\Controllers\Controller;

class RegisterController extends Controller
{

    public function get(){
        return view('auth.register');
    }
}
