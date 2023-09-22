<?php

namespace App\Modules\Course\Course\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Course\Course\Services\CourseService;

class CourseDeleteController extends Controller
{
    private $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->middleware('permission:delete courses', ['only' => ['get']]);
        $this->courseService = $courseService;
    }

    public function get($id){
        $course = $this->courseService->getById($id);

        try {
            //code...
            $this->courseService->delete(
                $course
            );
            return redirect()->back()->with('success_status', 'Course deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
