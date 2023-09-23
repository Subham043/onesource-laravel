<?php

namespace App\Modules\Enquiry\EnrollmentForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\EnrollmentForm\Services\EnrollmentFormService;

class EnrollmentFormDeleteController extends Controller
{
    private $enrollmentFormService;

    public function __construct(EnrollmentFormService $enrollmentFormService)
    {
        $this->middleware('permission:delete enquiries', ['only' => ['get']]);
        $this->enrollmentFormService = $enrollmentFormService;
    }

    public function get($id){
        $enrollment = $this->enrollmentFormService->getById($id);

        try {
            //code...
            $this->enrollmentFormService->delete(
                $enrollment
            );
            return redirect()->back()->with('success_status', 'Enrollment Form deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
