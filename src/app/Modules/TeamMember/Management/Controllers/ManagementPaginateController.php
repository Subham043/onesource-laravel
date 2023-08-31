<?php

namespace App\Modules\TeamMember\Management\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\TeamMember\Management\Services\ManagementService;
use Illuminate\Http\Request;

class ManagementPaginateController extends Controller
{
    private $managementService;

    public function __construct(ManagementService $managementService)
    {
        $this->middleware('permission:list team member managements', ['only' => ['get']]);
        $this->managementService = $managementService;
    }

    public function get(Request $request){
        $data = $this->managementService->paginate($request->total ?? 10);
        return view('admin.pages.team_member.management.paginate', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
