<?php

namespace App\Modules\Enquiry\CourseRequestForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\CourseRequestForm\Exports\CourseRequestFormExport;
use Maatwebsite\Excel\Facades\Excel;

class CourseRequestFormExcelController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:list enquiries', ['only' => ['get']]);
    }

    public function get(){
        return Excel::download(new CourseRequestFormExport, 'course_request_form.xlsx');
    }

}
