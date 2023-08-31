<?php

namespace App\Modules\TeamMember\Management\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\TeamMember\Management\Services\ManagementService;

class ManagementDeleteController extends Controller
{
    private $managementService;

    public function __construct(ManagementService $managementService)
    {
        $this->middleware('permission:delete team member managements', ['only' => ['get']]);
        $this->managementService = $managementService;
    }

    public function get($id){
        $management = $this->managementService->getById($id);

        try {
            //code...
            $this->managementService->delete(
                $management
            );
            return redirect()->back()->with('success_status', 'Management deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
