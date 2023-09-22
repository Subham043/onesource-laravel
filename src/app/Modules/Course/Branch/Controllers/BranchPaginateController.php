<?php

namespace App\Modules\Course\Branch\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Course\Branch\Services\BranchService;
use Illuminate\Http\Request;

class BranchPaginateController extends Controller
{
    private $branchService;

    public function __construct(BranchService $branchService)
    {
        $this->middleware('permission:list courses', ['only' => ['get']]);
        $this->branchService = $branchService;
    }

    public function get(Request $request){
        $data = $this->branchService->paginate($request->total ?? 10);
        return view('admin.pages.course.branch.paginate', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
