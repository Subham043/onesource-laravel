<?php

namespace App\Modules\Enquiry\ContactForm\Requests;

use App\Enums\Branch;
use App\Enums\RequestType;
use App\Http\Services\RateLimitService;
use Illuminate\Foundation\Http\FormRequest;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Validation\Rules\Enum;


class ContactFormRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|numeric|digits:10',
            'detail' => 'required|string|max:500',
            'course' => 'required|string|max:500',
            'location' => 'required|string|max:500',
            'date' => 'required|string|max:500',
            'time' => 'required|string|max:500',
            'page_url' => 'required|url|max:500',
            'request_type' => ['required', new Enum(RequestType::class)],
            'branch' => ['nullable','required_if:request_type,'.RequestType::VISIT_OUR_CENTER->value, new Enum(Branch::class)],
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
