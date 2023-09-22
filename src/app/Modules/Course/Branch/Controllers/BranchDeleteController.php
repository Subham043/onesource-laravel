<?php

namespace App\Modules\Course\Branch\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Course\Branch\Services\BranchService;

class BranchDeleteController extends Controller
{
    private $branchService;

    public function __construct(BranchService $branchService)
    {
        $this->middleware('permission:delete courses', ['only' => ['get']]);
        $this->branchService = $branchService;
    }

    public function get($id){
        $course = $this->branchService->getById($id);

        try {
            //code...
            $this->branchService->delete(
                $course
            );
            return redirect()->back()->with('success_status', 'Branch deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
