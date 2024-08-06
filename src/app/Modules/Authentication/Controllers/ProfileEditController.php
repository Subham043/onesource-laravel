<?php

namespace App\Modules\Authentication\Controllers;

use App\Enums\Timezone;
use App\Http\Controllers\Controller;
use App\Http\Services\RateLimitService;
use App\Modules\Authentication\Models\User;
use App\Modules\Authentication\Requests\ProfilePostRequest;
use App\Modules\Authentication\Services\AuthService;
use App\Modules\Document\Models\DocumentNotification;
use App\Modules\User\Services\UserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Arr;

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
        return view('profile.edit', compact('data'))->with([
            'page_name' => 'Profile',
            'timezones' => Arr::map(Timezone::cases(), fn($enum) => $enum->value),
            'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get()
        ]);
    }

    public function post(ProfilePostRequest $request){

        try {
            //code...
            $user = $this->authService->authenticated_user();
            $password_arr = [];
            if(!empty($request->password)){
                $password_arr = [ ...$request->safe()->only(['password'])];
            }
            $data = $this->authService->updateProfile(
                [
                    ...$request->safe()->only(['name', 'email', 'phone', 'timezone']),
                    ...$password_arr,
                ],
                $user
            );
            if($request->file('image') && $request->file('image')->isValid()){
                $file = $request->file('image')->hashName();
                $request->file('image')->storeAs((new User)->image_path,$file);
                $data->image = $file;
                $data->save();
            }
            if ($request->user()->isDirty('email')) {
                $request->user()->email_verified_at = null;
                $request->user()->sendEmailVerificationNotification();
                $request->user()->save();
                event(new Registered($user));
            }
            (new RateLimitService($request))->clearRateLimit();
            return redirect()->intended(route('profile.edit.get'))->with('success_status', 'Profile updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->intended(route('profile.edit.get'))->with('error_status', 'something went wrong. Please try again.');
        }

    }
}
