<?php

namespace App\Modules\Enquiry\ScholarForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\ScholarForm\Exports\ScholarFormExport;
use Maatwebsite\Excel\Facades\Excel;

class ScholarFormExcelController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:list enquiries', ['only' => ['get']]);
    }

    public function get(){
        return Excel::download(new ScholarFormExport, 'scholar_form.xlsx');
    }

}
