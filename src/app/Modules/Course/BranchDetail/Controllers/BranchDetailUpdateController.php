<?php

namespace App\Modules\Course\BranchDetail\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Course\Branch\Services\BranchService;
use App\Modules\Course\BranchDetail\Requests\BranchDetailRequest;
use App\Modules\Course\BranchDetail\Services\BranchDetailService;
use App\Modules\Course\Course\Services\CourseService;

class BranchDetailUpdateController extends Controller
{
    private $branchDetailService;
    private $courseService;
    private $branchService;

    public function __construct(BranchDetailService $branchDetailService, CourseService $courseService, BranchService $branchService)
    {
        $this->middleware('permission:edit courses', ['only' => ['get','post']]);
        $this->branchDetailService = $branchDetailService;
        $this->courseService = $courseService;
        $this->branchService = $branchService;
    }

    public function get($course_id, $branch_id){
        $course = $this->courseService->getById($course_id);
        $branch = $this->branchService->getById($branch_id);
        $data = $this->branchDetailService->getByCourseIdAndBranchId($course_id, $branch_id);
        return view('admin.pages.course.branchDetail.update', compact(['data', 'course_id', 'branch_id', 'course', 'branch']));
    }

    public function post(BranchDetailRequest $request, $course_id, $branch_id){
        $this->courseService->getById($course_id);
        $this->branchService->getById($branch_id);
        try {
            //code...
            $this->branchDetailService->createOrUpdate(
                $request->validated(),
                $course_id,
                $branch_id
            );
            return response()->json(["message" => "Event BranchDetail updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }
    }
}
