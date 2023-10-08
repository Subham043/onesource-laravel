<?php

namespace App\Modules\User\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\User\Services\UserService;

class UserViewController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->middleware('permission:view users', ['only' => ['get']]);
        $this->userService = $userService;
    }

    public function get($id){
        $user = $this->userService->getById($id);
        return view('users.view')->with([
            'page_name' => 'User',
            'user' => $user
        ]);
    }
}
