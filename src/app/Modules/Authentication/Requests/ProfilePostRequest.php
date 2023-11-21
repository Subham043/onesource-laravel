<?php

namespace App\Modules\Authentication\Requests;

use App\Enums\Timezone;
use App\Http\Services\RateLimitService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rules\Enum;


class ProfilePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        (new RateLimitService($this))->ensureIsNotRateLimited(3);
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.Auth::user()->id,
            'phone' => 'required|regex:/(^[0-9 \+\-\(\)]+$)+/|unique:users,phone,'.Auth::user()->id,
            'old_password' => ['nullable', 'required_with:password','string', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    $fail('The '.$attribute.' entered is incorrect.');
                }
            }],
            'password' => ['nullable', 'required_with:old_password',
                'string',
                Password::min(8)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
            ],
            'confirm_password' => 'nullable|string|min:6|required_with:password|same:password',
            'timezone' => ['required', new Enum(Timezone::class)],
            'image' => 'nullable|image|max:5000'
        ];
    }

    /**
     * Handle a passed validation attempt.
     *
     * @return void
     */
    protected function passedValidation()
    {
        $this->replace(
            Purify::clean(
                $this->all()
            )
        );
    }
}
