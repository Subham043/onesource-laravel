<?php

namespace App\Modules\Achiever\Student\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Achiever\Category\Services\CategoryService;
use App\Modules\Achiever\Student\Requests\StudentUpdateRequest;
use App\Modules\Achiever\Student\Services\StudentService;

class StudentUpdateController extends Controller
{
    private $studentService;
    private $categoryService;

    public function __construct(StudentService $studentService, CategoryService $categoryService)
    {
        $this->middleware('permission:edit achievers', ['only' => ['get','post']]);
        $this->studentService = $studentService;
        $this->categoryService = $categoryService;
    }

    public function get($id){
        $data = $this->studentService->getById($id);
        $category = $this->categoryService->all();
        $categories =$data->categories->pluck('id')->toArray();
        return view('admin.pages.achiever.student.update', compact(['data', 'category', 'categories']));
    }

    public function post(StudentUpdateRequest $request, $id){
        $student = $this->studentService->getById($id);
        try {
            //code...
            $this->studentService->update(
                $request->except('image'),
                $student
            );
            if($request->hasFile('image')){
                $this->studentService->saveImage($student);
            }
            if($request->category && count($request->category)>0){
                $this->studentService->save_categories($student, $request->category);
            }
            return response()->json(["message" => "Student updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
