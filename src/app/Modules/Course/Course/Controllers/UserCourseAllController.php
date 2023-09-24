<?php

namespace App\Modules\Course\Course\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Course\Course\Resources\UserCourseMainAllCollection;
use App\Modules\Course\Course\Services\CourseService;

class UserCourseAllController extends Controller
{
    private $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function get(){
        $course = $this->courseService->all_main();
        return response()->json([
            'message' => "Course recieved successfully.",
            'course' => UserCourseMainAllCollection::collection($course),
        ], 200);
    }
}
