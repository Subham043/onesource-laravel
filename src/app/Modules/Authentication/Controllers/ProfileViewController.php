<?php

namespace App\Modules\Authentication\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Authentication\Services\AuthService;
use App\Modules\Document\Models\DocumentNotification;

class ProfileViewController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function get(){
        $data = $this->authService->authenticated_user();
        return view('profile.view', compact('data'))->with([
            'page_name' => 'Profile',
            'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get()
        ]);
    }
}
