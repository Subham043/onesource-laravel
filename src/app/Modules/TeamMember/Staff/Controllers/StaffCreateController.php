<?php

namespace App\Modules\TeamMember\Staff\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\TeamMember\Staff\Requests\StaffCreateRequest;
use App\Modules\TeamMember\Staff\Services\StaffService;

class StaffCreateController extends Controller
{
    private $staffService;

    public function __construct(StaffService $staffService)
    {
        $this->middleware('permission:create team member staffs', ['only' => ['get','post']]);
        $this->staffService = $staffService;
    }

    public function get(){
        return view('admin.pages.team_member.staff.create');
    }

    public function post(StaffCreateRequest $request){

        try {
            //code...
            $staff = $this->staffService->create(
                $request->except('image')
            );
            if($request->image==true && $request->hasFile('image')){
                $this->staffService->saveImage($staff);
            }
            return response()->json(["message" => "Staff created successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
