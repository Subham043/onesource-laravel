<?php

namespace App\Modules\Authentication\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Authentication\Services\AuthService;

class ProfileViewController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function get(){
        $data = $this->authService->authenticated_user();
        return view('profile.view', compact('data'));
    }
}
