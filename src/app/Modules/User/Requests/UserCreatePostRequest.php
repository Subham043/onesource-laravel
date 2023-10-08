<?php

namespace App\Modules\User\Requests;

use App\Enums\Timezone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Validation\Rules\Password as PasswordValidation;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rule;


class UserCreatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'name' => ['required', 'string'],
            'email' => ['required','email:rfc,dns','unique:users'],
            'phone' => ['required','numeric', 'gt:0', 'unique:users'],
            'password' => ['required',
                'string',
                PasswordValidation::min(8)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                        ->uncompromised()
            ],
            'confirm_password' => ['required_with:password','same:password'],
            'timezone' => ['required', new Enum(Timezone::class)],
            'role' => ['required', 'string', 'in:Staff-Admin,Client,Writer', 'exists:Spatie\Permission\Models\Role,name'],
            'billing_rate' => ['nullable', Rule::requiredIf($this->role==='Client' || $this->role==='Writer'), 'numeric', 'gt:0'],
            'tool' => ['nullable', Rule::requiredIf($this->role==='Writer'), 'array', 'min:1'],
            'tool.*' => ['nullable', Rule::requiredIf($this->role==='Writer'), 'numeric', 'exists:App\Modules\Tool\Models\Tool,id'],
            'client' => ['nullable', Rule::requiredIf($this->role==='Client'), 'exists:App\Modules\Client\Models\Client,id'],
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
