<?php

namespace App\Modules\Achiever\Student\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Achiever\Student\Resources\UserStudentCollection;
use App\Modules\Achiever\Student\Services\StudentService;
use Illuminate\Http\Request;

class UserStudentPaginateController extends Controller
{
    private $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function get(Request $request){
        $student = $this->studentService->paginateMain($request->total ?? 10);
        return UserStudentCollection::collection($student);
    }

}
