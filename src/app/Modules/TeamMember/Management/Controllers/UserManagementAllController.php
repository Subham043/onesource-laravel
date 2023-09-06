<?php

namespace App\Modules\TeamMember\Management\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\TeamMember\Management\Resources\UserManagementCollection;
use App\Modules\TeamMember\Management\Services\ManagementService;

class UserManagementAllController extends Controller
{
    private $managementService;

    public function __construct(ManagementService $managementService)
    {
        $this->managementService = $managementService;
    }

    public function get(){
        $data = $this->managementService->allMain();
        return UserManagementCollection::collection($data);
    }

}
