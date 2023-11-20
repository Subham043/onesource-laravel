<?php

namespace App\Modules\Customer\Requests;

use App\Enums\State;
use App\Enums\Timezone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Validation\Rules\Enum;


class CustomerUpdatePostRequest extends FormRequest
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
            'email' => ['required','email:rfc,dns','unique:users,email,'.$this->route('id')],
            'phone' => ['required','regex:/(^[0-9 \+\-]+$)+/', 'unique:users,phone,'.$this->route('id')],
            'timezone' => ['required', new Enum(Timezone::class)],
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
