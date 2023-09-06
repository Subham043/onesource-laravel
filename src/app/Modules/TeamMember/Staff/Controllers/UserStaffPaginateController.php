<?php

namespace App\Modules\TeamMember\Staff\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\TeamMember\Staff\Resources\UserStaffCollection;
use App\Modules\TeamMember\Staff\Services\StaffService;
use Illuminate\Http\Request;

class UserStaffPaginateController extends Controller
{
    private $staffService;

    public function __construct(StaffService $staffService)
    {
        $this->staffService = $staffService;
    }

    public function get(Request $request){
        $data = $this->staffService->paginateMain($request->total ?? 10);
        return UserStaffCollection::collection($data);
    }

}
