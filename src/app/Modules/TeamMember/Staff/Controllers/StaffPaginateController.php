<?php

namespace App\Modules\TeamMember\Staff\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\TeamMember\Staff\Services\StaffService;
use Illuminate\Http\Request;

class StaffPaginateController extends Controller
{
    private $staffService;

    public function __construct(StaffService $staffService)
    {
        $this->middleware('permission:list team member staffs', ['only' => ['get']]);
        $this->staffService = $staffService;
    }

    public function get(Request $request){
        $data = $this->staffService->paginate($request->total ?? 10);
        return view('admin.pages.team_member.staff.paginate', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
