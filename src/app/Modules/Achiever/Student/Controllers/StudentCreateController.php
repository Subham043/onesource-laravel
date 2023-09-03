<?php

namespace App\Modules\Achiever\Student\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Achiever\Category\Services\CategoryService;
use App\Modules\Achiever\Student\Requests\StudentCreateRequest;
use App\Modules\Achiever\Student\Services\StudentService;

class StudentCreateController extends Controller
{
    private $studentService;
    private $categoryService;

    public function __construct(StudentService $studentService, CategoryService $categoryService)
    {
        $this->middleware('permission:create achievers', ['only' => ['get','post']]);
        $this->studentService = $studentService;
        $this->categoryService = $categoryService;
    }

    public function get(){
        $category = $this->categoryService->all();
        return view('admin.pages.achiever.student.create', compact(['category']));
    }

    public function post(StudentCreateRequest $request){

        try {
            //code...
            $student = $this->studentService->create(
                $request->except('image')
            );
            if($request->hasFile('image')){
                $this->studentService->saveImage($student);
            }
            if($request->category && count($request->category)>0){
                $this->studentService->save_categories($student, $request->category);
            }
            return response()->json(["message" => "Student created successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
