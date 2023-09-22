<?php

namespace App\Modules\Course\Branch\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Course\Branch\Resources\UserBranchCollection;
use App\Modules\Course\Branch\Services\BranchService;

class UserBranchDetailController extends Controller
{
    private $branchService;

    public function __construct(BranchService $branchService)
    {
        $this->branchService = $branchService;
    }

    public function get($slug){
        $course = $this->branchService->getBySlug($slug);
        return response()->json([
            'message' => "Branch recieved successfully.",
            'course' => UserBranchCollection::make($course),
        ], 200);
    }
}
