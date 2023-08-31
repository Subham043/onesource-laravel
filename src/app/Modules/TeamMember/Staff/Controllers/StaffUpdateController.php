<?php

namespace App\Modules\TeamMember\Staff\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\TeamMember\Staff\Requests\StaffUpdateRequest;
use App\Modules\TeamMember\Staff\Services\StaffService;

class StaffUpdateController extends Controller
{
    private $staffService;

    public function __construct(StaffService $staffService)
    {
        $this->middleware('permission:edit team member staffs', ['only' => ['get','post']]);
        $this->staffService = $staffService;
    }

    public function get($id){
        $data = $this->staffService->getById($id);
        return view('admin.pages.team_member.staff.update', compact('data'));
    }

    public function post(StaffUpdateRequest $request, $id){
        $staff = $this->staffService->getById($id);
        try {
            //code...
            $this->staffService->update(
                $request->except('image'),
                $staff
            );
            if($request->hasFile('image')){
                $this->staffService->saveImage($staff);
            }
            return response()->json(["message" => "Staff updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
