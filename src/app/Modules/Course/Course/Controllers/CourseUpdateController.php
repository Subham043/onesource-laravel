<?php

namespace App\Modules\Course\Course\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Course\Course\Requests\CourseUpdateRequest;
use App\Modules\Course\Course\Services\CourseService;

class CourseUpdateController extends Controller
{
    private $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->middleware('permission:edit courses', ['only' => ['get','post']]);
        $this->courseService = $courseService;
    }

    public function get($id){
        $data = $this->courseService->getById($id);
        return view('admin.pages.course.course.update', compact(['data']));
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
            return response()->json(["message" => "Course updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
