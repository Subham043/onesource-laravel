<?php

namespace App\Modules\Enquiry\EnrollmentForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\EnrollmentForm\Exports\EnrollmentFormExport;
use Maatwebsite\Excel\Facades\Excel;

class EnrollmentFormExcelController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:list enquiries', ['only' => ['get']]);
    }

    public function get(){
        return Excel::download(new EnrollmentFormExport, 'enrollment_form.xlsx');
    }

}
