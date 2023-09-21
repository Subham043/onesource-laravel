<?php

namespace App\Modules\Enquiry\VrddhiForm\Requests;

use App\Enums\VrddhiClassEnum;
use App\Enums\VrddhiSyllabusEnum;
use App\Http\Services\RateLimitService;
use Illuminate\Foundation\Http\FormRequest;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Validation\Rules\Enum;


class VrddhiFormRequest extends FormRequest
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
            'school_name' => 'required|string|max:255',
            'phone' => 'required|numeric|digits:10',
            'father_name' => 'required|string|max:255',
            'father_email' => 'required|email',
            'father_phone' => 'required|numeric|digits:10',
            'mother_name' => 'required|string|max:255',
            'mother_email' => 'required|email',
            'mother_phone' => 'required|numeric|digits:10',
            'card' => 'required|image|min:1|max:5000',
            'class' => ['required', new Enum(VrddhiClassEnum::class)],
            'syllabus' => ['required', new Enum(VrddhiSyllabusEnum::class)],
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
