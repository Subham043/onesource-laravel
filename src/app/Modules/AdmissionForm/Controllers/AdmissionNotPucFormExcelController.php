<?php

namespace App\Modules\AdmissionForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\AdmissionForm\Exports\AdmissionNotPucFormExport;
use Maatwebsite\Excel\Facades\Excel;

class AdmissionNotPucFormExcelController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:list admissions', ['only' => ['get']]);
    }

    public function get(){
        return Excel::download(new AdmissionNotPucFormExport, 'admission_form.xlsx');
    }

}
