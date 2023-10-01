<?php

namespace App\Modules\Authentication\Services;

use Illuminate\Support\Facades\Auth;
use App\Modules\Authentication\Models\User;
use App\Modules\Authentication\Requests\RegisterPostRequest;

class AuthService
{

    public function logout(): void
    {
        Auth::logout();
    }

    public function login(array $credentials): bool
    {
        return Auth::attempt($credentials);
    }

    public function register(RegisterPostRequest $request): User
    {
        $user = User::create($request->safe()->only([
            'name',
            'email',
            'phone',
            'password',
            'timezone',
            'question_1',
            'answer_1',
            'question_2',
            'answer_2',
            'question_3',
            'answer_3',
        ]));
        $user->syncRoles(['Admin']);
        $user->profiles()->create([
            ...$request->safe()->only([
                'company',
                'address',
                'city',
                'state',
                'zip',
                'website',
            ]),
            'created_by' => $user->id
        ]);
        $user->payments()->create([
            'paid_by' => $user->id
        ]);
        $user->save();
        return $user;
    }

    public function authenticated_user(): User
    {
        return Auth::user();
    }

    public function user_profile(): User
    {
        return Auth::user();
    }

}
