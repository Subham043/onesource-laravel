<?php

namespace App\Modules\Achiever\Student\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Achiever\Student\Services\StudentService;

class StudentDeleteController extends Controller
{
    private $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->middleware('permission:delete achievers', ['only' => ['get']]);
        $this->studentService = $studentService;
    }

    public function get($id){
        $student = $this->studentService->getById($id);

        try {
            //code...
            $this->studentService->delete(
                $student
            );
            return redirect()->back()->with('success_status', 'Student deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
