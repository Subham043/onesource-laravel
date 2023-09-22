<?php

namespace App\Modules\Course\Course\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Course\Course\Resources\UserCourseCollection;
use App\Modules\Course\Course\Services\CourseService;

class UserCourseDetailController extends Controller
{
    private $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function get($slug){
        $course = $this->courseService->getBySlug($slug);
        return response()->json([
            'message' => "Course recieved successfully.",
            'course' => UserCourseCollection::make($course),
        ], 200);
    }
}
