<?php

namespace App\Modules\Enquiry\EnrollmentForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\EnrollmentForm\Services\EnrollmentFormService;
use Illuminate\Http\Request;

class EnrollmentFormPaginateController extends Controller
{
    private $enrollmentFormService;

    public function __construct(EnrollmentFormService $enrollmentFormService)
    {
        $this->middleware('permission:list enquiries', ['only' => ['get']]);
        $this->enrollmentFormService = $enrollmentFormService;
    }

    public function get(Request $request){
        $data = $this->enrollmentFormService->paginate($request->total ?? 10);
        return view('admin.pages.enquiry.enrollment_form', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
