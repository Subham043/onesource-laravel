<?php

namespace App\Modules\Course\Course\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Course\Branch\Services\BranchService;
use App\Modules\Course\Course\Requests\CourseCreateRequest;
use App\Modules\Course\Course\Services\CourseService;

class CourseCreateController extends Controller
{
    private $courseService;
    private $branchService;

    public function __construct(CourseService $courseService, BranchService $branchService)
    {
        $this->middleware('permission:create courses', ['only' => ['get','post']]);
        $this->courseService = $courseService;
        $this->branchService = $branchService;
    }

    public function get(){
        $branch = $this->branchService->all();
        return view('admin.pages.course.course.create', compact(['branch']));
    }

    public function post(CourseCreateRequest $request){

        try {
            //code...
            $course = $this->courseService->create(
                $request->except(['image'])
            );
            if($request->hasFile('image')){
                $this->courseService->saveImage($course);
            }
            if($request->branch && count($request->branch)>0){
                $this->courseService->save_branches($course, $request->branch);
            }
            return response()->json(["message" => "Course created successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
