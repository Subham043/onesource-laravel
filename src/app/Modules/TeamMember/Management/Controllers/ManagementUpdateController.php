<?php

namespace App\Modules\TeamMember\Management\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\TeamMember\Management\Requests\ManagementUpdateRequest;
use App\Modules\TeamMember\Management\Services\ManagementService;

class ManagementUpdateController extends Controller
{
    private $managementService;

    public function __construct(ManagementService $managementService)
    {
        $this->middleware('permission:edit team member managements', ['only' => ['get','post']]);
        $this->managementService = $managementService;
    }

    public function get($id){
        $data = $this->managementService->getById($id);
        return view('admin.pages.team_member.management.update', compact('data'));
    }

    public function post(ManagementUpdateRequest $request, $id){
        $management = $this->managementService->getById($id);
        try {
            //code...
            $this->managementService->update(
                $request->except('image'),
                $management
            );
            if($request->hasFile('image')){
                $this->managementService->saveImage($management);
            }
            return response()->json(["message" => "Management updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
