<?php

namespace App\Modules\Course\Branch\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Course\Branch\Resources\UserBranchMainCollection;
use App\Modules\Course\Branch\Services\BranchService;

class UserBranchAllController extends Controller
{
    private $branchService;

    public function __construct(BranchService $branchService)
    {
        $this->branchService = $branchService;
    }

    public function get(){
        $branch = $this->branchService->main_all();
        return response()->json([
            'message' => "Branch Pages recieved successfully.",
            'branch' => UserBranchMainCollection::collection($branch),
        ], 200);
    }

}
