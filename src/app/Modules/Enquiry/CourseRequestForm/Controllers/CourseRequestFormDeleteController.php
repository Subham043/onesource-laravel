<?php

namespace App\Modules\Enquiry\CourseRequestForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\CourseRequestForm\Services\CourseRequestFormService;

class CourseRequestFormDeleteController extends Controller
{
    private $courseRequestFormService;

    public function __construct(CourseRequestFormService $courseRequestFormService)
    {
        $this->middleware('permission:delete enquiries', ['only' => ['get']]);
        $this->courseRequestFormService = $courseRequestFormService;
    }

    public function get($id){
        $courseRequest = $this->courseRequestFormService->getById($id);

        try {
            //code...
            $this->courseRequestFormService->delete(
                $courseRequest
            );
            return redirect()->back()->with('success_status', 'CourseRequest Form deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
