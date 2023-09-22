<?php

namespace App\Modules\Course\Branch\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Course\Branch\Requests\BranchCreateRequest;
use App\Modules\Course\Branch\Services\BranchService;

class BranchCreateController extends Controller
{
    private $branchService;

    public function __construct(BranchService $branchService)
    {
        $this->middleware('permission:create courses', ['only' => ['get','post']]);
        $this->branchService = $branchService;
    }

    public function get(){
        return view('admin.pages.course.branch.create');
    }

    public function post(BranchCreateRequest $request){

        try {
            //code...
            $branch = $this->branchService->create(
                $request->except(['image'])
            );
            return response()->json(["message" => "Branch created successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
