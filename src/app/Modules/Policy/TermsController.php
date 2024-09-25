<?php

namespace App\Modules\Policy;

use App\Http\Controllers\Controller;

class TermsController extends Controller
{
    public function get(){
        return view('policy.terms');
    }
}
