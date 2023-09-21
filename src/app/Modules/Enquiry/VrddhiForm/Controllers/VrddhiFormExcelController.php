<?php

namespace App\Modules\Enquiry\VrddhiForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\VrddhiForm\Exports\VrddhiFormExport;
use Maatwebsite\Excel\Facades\Excel;

class VrddhiFormExcelController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:list enquiries', ['only' => ['get']]);
    }

    public function get(){
        return Excel::download(new VrddhiFormExport, 'vrddhi_form.xlsx');
    }

}
