<?php

namespace App\Modules\Authentication\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\RateLimitService;
use App\Modules\Authentication\Requests\RegisterPostRequest;
use App\Modules\Authentication\Services\AuthService;

class RegisterController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function get(){
        return view('auth.register');
    }

    public function post(RegisterPostRequest $request){

        $user = $this->authService->register($request);

        if ($user) {
            (new RateLimitService($request))->clearRateLimit();
            return redirect()->intended(route('login.get'))->with('success_status', 'Registered successfully.');
        }

        return redirect(route('register.get'))->with('error_status', 'Oops! something went wrong. Please try again.');
    }
}
