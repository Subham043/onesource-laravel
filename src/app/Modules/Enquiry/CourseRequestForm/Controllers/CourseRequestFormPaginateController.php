<?php

namespace App\Modules\Enquiry\CourseRequestForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\CourseRequestForm\Services\CourseRequestFormService;
use Illuminate\Http\Request;

class CourseRequestFormPaginateController extends Controller
{
    private $courseRequestFormService;

    public function __construct(CourseRequestFormService $courseRequestFormService)
    {
        $this->middleware('permission:list enquiries', ['only' => ['get']]);
        $this->courseRequestFormService = $courseRequestFormService;
    }

    public function get(Request $request){
        $data = $this->courseRequestFormService->paginate($request->total ?? 10);
        return view('admin.pages.enquiry.course_request_form', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
