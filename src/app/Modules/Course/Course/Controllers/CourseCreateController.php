<?php

namespace App\Modules\Course\Course\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Course\Course\Requests\CourseCreateRequest;
use App\Modules\Course\Course\Services\CourseService;

class CourseCreateController extends Controller
{
    private $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->middleware('permission:create courses', ['only' => ['get','post']]);
        $this->courseService = $courseService;
    }

    public function get(){
        return view('admin.pages.course.course.create');
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
            return response()->json(["message" => "Course created successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
