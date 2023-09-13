<?php

namespace App\Modules\AdmissionForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\AdmissionForm\Services\AdmissionFormService;
use Illuminate\Http\Request;

class AdmissionPucFormPaginateController extends Controller
{
    private $admissionFormService;

    public function __construct(AdmissionFormService $admissionFormService)
    {
        $this->middleware('permission:list admissions', ['only' => ['get']]);
        $this->admissionFormService = $admissionFormService;
    }

    public function get(Request $request){
        $data = $this->admissionFormService->paginatePuc($request->total ?? 10);
        return view('admin.pages.admission.puc_class', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
