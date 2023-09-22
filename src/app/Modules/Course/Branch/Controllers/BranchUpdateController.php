<?php

namespace App\Modules\Course\Branch\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Course\Branch\Requests\BranchUpdateRequest;
use App\Modules\Course\Branch\Services\BranchService;

class BranchUpdateController extends Controller
{
    private $branchService;

    public function __construct(BranchService $branchService)
    {
        $this->middleware('permission:edit courses', ['only' => ['get','post']]);
        $this->branchService = $branchService;
    }

    public function get($id){
        $data = $this->branchService->getById($id);
        return view('admin.pages.course.branch.update', compact(['data']));
    }

    public function post(BranchUpdateRequest $request, $id){
        $branch = $this->branchService->getById($id);
        try {
            //code...
            $this->branchService->update(
                $request->except(['image']),
                $branch
            );
            return response()->json(["message" => "Branch updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
