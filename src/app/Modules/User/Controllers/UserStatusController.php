<?php

namespace App\Modules\User\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\User\Services\UserService;

class UserStatusController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->middleware('permission:edit users', ['only' => ['get']]);
        $this->userService = $userService;
    }

    public function get($id){
        $data = $this->userService->getById($id);
        $data->is_blocked = !$data->is_blocked;
        $data->save();
        return redirect()->back()->with(['success_status' => 'User Status Updated Successfully']);
    }
}
