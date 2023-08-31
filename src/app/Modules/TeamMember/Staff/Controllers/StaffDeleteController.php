<?php

namespace App\Modules\TeamMember\Staff\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\TeamMember\Staff\Services\StaffService;

class StaffDeleteController extends Controller
{
    private $staffService;

    public function __construct(StaffService $staffService)
    {
        $this->middleware('permission:delete team member staffs', ['only' => ['get']]);
        $this->staffService = $staffService;
    }

    public function get($id){
        $staff = $this->staffService->getById($id);

        try {
            //code...
            $this->staffService->delete(
                $staff
            );
            return redirect()->back()->with('success_status', 'Staff deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
