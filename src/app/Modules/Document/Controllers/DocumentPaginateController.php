<?php

namespace App\Modules\Document\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentPaginateController extends Controller
{
    public function get(Request $request){
        return view('documents.list');
    }

}
