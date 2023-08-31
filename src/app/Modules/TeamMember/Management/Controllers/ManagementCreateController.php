<?php

namespace App\Modules\TeamMember\Management\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\TeamMember\Management\Requests\ManagementCreateRequest;
use App\Modules\TeamMember\Management\Services\ManagementService;

class ManagementCreateController extends Controller
{
    private $managementService;

    public function __construct(ManagementService $managementService)
    {
        $this->middleware('permission:create team member managements', ['only' => ['get','post']]);
        $this->managementService = $managementService;
    }

    public function get(){
        return view('admin.pages.team_member.management.create');
    }

    public function post(ManagementCreateRequest $request){

        try {
            //code...
            $management = $this->managementService->create(
                $request->except('image')
            );
            if($request->image==true && $request->hasFile('image')){
                $this->managementService->saveImage($management);
            }
            return response()->json(["message" => "Management created successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
