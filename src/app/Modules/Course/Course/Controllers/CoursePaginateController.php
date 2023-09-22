<?php

namespace App\Modules\Course\Course\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Course\Course\Services\CourseService;
use Illuminate\Http\Request;

class CoursePaginateController extends Controller
{
    private $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->middleware('permission:list courses', ['only' => ['get']]);
        $this->courseService = $courseService;
    }

    public function get(Request $request){
        $data = $this->courseService->paginate($request->total ?? 10);
        return view('admin.pages.course.course.paginate', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
