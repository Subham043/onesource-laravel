<?php

namespace App\Modules\Policy;

use App\Http\Controllers\Controller;

class PrivacyController extends Controller
{
    public function get(){
        return view('policy.privacy');
    }
}
