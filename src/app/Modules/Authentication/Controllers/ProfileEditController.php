<?php

namespace App\Modules\Authentication\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\RateLimitService;
use App\Modules\Authentication\Requests\ProfilePostRequest;
use App\Modules\Authentication\Services\AuthService;
use App\Modules\User\Services\UserService;

class ProfileEditController extends Controller
{
    private $authService;
    private $userService;

    public function __construct(AuthService $authService, UserService $userService)
    {
        $this->authService = $authService;
        $this->userService = $userService;
    }

    public function get(){
        $data = $this->authService->authenticated_user();
        return view('profile.edit', compact('data'));
    }

    public function post(ProfilePostRequest $request){

        try {
            //code...
            $user = $this->authService->authenticated_user();
            $this->userService->update(
                $request->safe()->only(['name', 'email', 'phone', 'password', 'timezone']),
                $user
            );
            (new RateLimitService($request))->clearRateLimit();
            return redirect()->intended(route('profile.edit.get'))->with('success_status', 'Profile updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->intended(route('profile.edit.get'))->with('error_status', 'something went wrong. Please try again.');
        }

    }
}
