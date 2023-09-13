<?php

namespace App\Modules\AdmissionForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\AdmissionForm\Exports\AdmissionFormExport;
use Maatwebsite\Excel\Facades\Excel;

class AdmissionFormExcelController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:list admissions', ['only' => ['get']]);
    }

    public function get(){
        return Excel::download(new AdmissionFormExport, 'admission_form.xlsx');
    }

}
