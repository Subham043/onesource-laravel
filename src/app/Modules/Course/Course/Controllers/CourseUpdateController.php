<?php

namespace App\Modules\Course\Course\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Course\Branch\Services\BranchService;
use App\Modules\Course\Course\Requests\CourseUpdateRequest;
use App\Modules\Course\Course\Services\CourseService;

class CourseUpdateController extends Controller
{
    private $courseService;
    private $branchService;

    public function __construct(CourseService $courseService, BranchService $branchService)
    {
        $this->middleware('permission:edit courses', ['only' => ['get','post']]);
        $this->courseService = $courseService;
        $this->branchService = $branchService;
    }

    public function get($id){
        $data = $this->courseService->getById($id);
        $branch = $this->branchService->all();
        $branches =$data->branches->pluck('id')->toArray();
        return view('admin.pages.course.course.update', compact(['data', 'branch', 'branches']));
    }

    public function post(CourseUpdateRequest $request, $id){
        $course = $this->courseService->getById($id);
        try {
            //code...
            $this->courseService->update(
                $request->except(['image']),
                $course
            );
            if($request->hasFile('image')){
                $this->courseService->saveImage($course);
            }
            if($request->branch && count($request->branch)>0){
                $this->courseService->save_branches($course, $request->branch);
            }
            return response()->json(["message" => "Course updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
