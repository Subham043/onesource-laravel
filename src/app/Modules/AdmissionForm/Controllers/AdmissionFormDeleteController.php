<?php

namespace App\Modules\AdmissionForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\AdmissionForm\Services\AdmissionFormService;

class AdmissionFormDeleteController extends Controller
{
    private $admissionFormService;

    public function __construct(AdmissionFormService $admissionFormService)
    {
        $this->middleware('permission:delete admissions', ['only' => ['get']]);
        $this->admissionFormService = $admissionFormService;
    }

    public function get($id){
        $admission = $this->admissionFormService->getById($id);

        try {
            //code...
            $this->admissionFormService->delete(
                $admission
            );
            return redirect()->back()->with('success_status', 'Admission Form deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
