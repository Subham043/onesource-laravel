<?php

namespace App\Modules\Authentication\Requests;

use App\Enums\State;
use App\Enums\Timezone;
use App\Http\Services\RateLimitService;
use Illuminate\Foundation\Http\FormRequest;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Validation\Rules\Password as PasswordValidation;
use Illuminate\Validation\Rules\Enum;


class RegisterPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        (new RateLimitService($this))->ensureIsNotRateLimited(3);
        return true;
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
            ],
            'confirm_password' => ['required_with:password','same:password'],
            'timezone' => ['required', new Enum(Timezone::class)],
            'question_1' => ['required', 'string'],
            'answer_1' => ['required', 'string'],
            'question_2' => ['required', 'string'],
            'answer_2' => ['required', 'string'],
            'question_3' => ['required', 'string'],
            'answer_3' => ['required', 'string'],
            'company' => ['required', 'string'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string'],
            'state' => ['required', new Enum(State::class)],
            'zip' => ['required', 'string'],
            'website' => ['required', 'url'],
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
