<?php

namespace App\Modules\AdmissionForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\AdmissionForm\Exports\AdmissionPucFormExport;
use Maatwebsite\Excel\Facades\Excel;

class AdmissionPucFormExcelController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:list admissions', ['only' => ['get']]);
    }

    public function get(){
        return Excel::download(new AdmissionPucFormExport, 'admission_form.xlsx');
    }

}
