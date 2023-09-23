<?php

namespace App\Modules\Course\Course\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Course\Branch\Resources\UserBranchCollection;
use App\Modules\Course\Branch\Services\BranchService;
use App\Modules\Course\Course\Resources\UserCourseMainCollection;
use App\Modules\Course\Course\Services\CourseService;

class UserCourseDetailController extends Controller
{
    private $courseService;
    private $branchService;

    public function __construct(CourseService $courseService, BranchService $branchService)
    {
        $this->courseService = $courseService;
        $this->branchService = $branchService;
    }

    public function get($course_slug, $branch_slug){
        $branch = $this->branchService->getBySlug($branch_slug);
        $course = $this->courseService->getBySlugAndBranchDetail($course_slug, $branch_slug);
        return response()->json([
            'message' => "Course recieved successfully.",
            'course' => UserCourseMainCollection::make($course),
            'branch' => UserBranchCollection::make($branch),
        ], 200);
    }
}
