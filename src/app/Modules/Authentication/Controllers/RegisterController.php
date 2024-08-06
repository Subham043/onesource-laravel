<?php

namespace App\Modules\Authentication\Controllers;

use App\Enums\Timezone;
use App\Http\Controllers\Controller;
use App\Http\Services\RateLimitService;
use App\Modules\Authentication\Requests\RegisterPostRequest;
use App\Modules\Authentication\Services\AuthService;
use Illuminate\Support\Arr;

class RegisterController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function get(){
        return view('auth.register')->with([
            'timezones' => Arr::map(Timezone::cases(), fn($enum) => $enum->value),
        ]);
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
