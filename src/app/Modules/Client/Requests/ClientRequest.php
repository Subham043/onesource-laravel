<?php

namespace App\Modules\Client\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;


class ClientRequest extends FormRequest
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
            'name' => 'required|string|max:500',
            'email' => ['required','email:rfc,dns'],
            'phone' => ['required','regex:/(^[0-9 \+\-\(\)]+$)+/'],
            'onsite_billing_rate' => ['required', 'numeric', 'gte:0'],
            'remote_billing_rate' => ['required', 'numeric', 'gte:0'],
            'setup_time' => ['required', 'numeric', 'gte:0'],
            'address' => 'required|string',
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