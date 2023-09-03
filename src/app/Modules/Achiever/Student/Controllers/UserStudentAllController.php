<?php

namespace App\Modules\Achiever\Student\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Achiever\Student\Resources\UserStudentCollection;
use App\Modules\Achiever\Student\Services\StudentService;

class UserStudentAllController extends Controller
{
    private $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function get(){
        $student = $this->studentService->main_all();
        return response()->json([
            'message' => "Student recieved successfully.",
            'student' => UserStudentCollection::collection($student),
        ], 200);
    }

}
