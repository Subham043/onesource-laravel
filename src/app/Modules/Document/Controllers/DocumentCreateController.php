<?php

namespace App\Modules\Document\Controllers;

use App\Http\Controllers\Controller;

class DocumentCreateController extends Controller
{
    public function get(){
        return view('documents.add')->with([
            'page_name' => 'Document'
        ]);
    }
}
