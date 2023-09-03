<?php

namespace App\Modules\Achiever\Student\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Achiever\Student\Services\StudentService;
use Illuminate\Http\Request;

class StudentPaginateController extends Controller
{
    private $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->middleware('permission:list achievers', ['only' => ['get']]);
        $this->studentService = $studentService;
    }

    public function get(Request $request){
        $data = $this->studentService->paginate($request->total ?? 10);
        return view('admin.pages.achiever.student.paginate', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
