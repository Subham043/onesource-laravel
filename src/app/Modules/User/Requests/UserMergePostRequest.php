<?php

namespace App\Modules\User\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;


class UserMergePostRequest extends FormRequest
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
            'billing_rate' => ['nullable', 'numeric', 'gt:0'],
            'tool' => ['nullable', 'array', 'min:1'],
            'tool.*' => ['nullable', 'numeric', 'exists:App\Modules\Tool\Models\Tool,id'],
            'client' => ['nullable', 'exists:App\Modules\Client\Models\Client,id'],
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
