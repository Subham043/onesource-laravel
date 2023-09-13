<?php

namespace App\Modules\AdmissionForm\Requests;

use App\Enums\AdmissionBatchEnum;
use App\Enums\AdmissionCenterEnum;
use App\Enums\AdmissionSiblingEnum;
use App\Http\Services\RateLimitService;
use Illuminate\Foundation\Http\FormRequest;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Validation\Rules\Enum;


class AdmissionPucFormRequest extends FormRequest
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
            'aadhar' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'father_occupation' => 'required|string|max:255',
            'father_phone' => 'required|numeric|digits:10',
            'mother_name' => 'required|string|max:255',
            'mother_occupation' => 'required|string|max:255',
            'mother_phone' => 'required|numeric|digits:10',
            'address' => 'required|string|max:500',
            'marks' => 'required|image|min:1|max:5000',
            'center' => ['required', new Enum(AdmissionCenterEnum::class)],
            'bacth' => ['required', new Enum(AdmissionBatchEnum::class)],
            'sibling' => ['required', new Enum(AdmissionSiblingEnum::class)],
            'no_of_sibling' => ['nullable','required_if:sibling,'.AdmissionSiblingEnum::YES->value, 'numeric'],
            'sibling_occupation' => ['nullable','required_if:sibling,'.AdmissionSiblingEnum::YES->value, 'string'],
            'sibling_school' => ['nullable','required_if:sibling,'.AdmissionSiblingEnum::YES->value, 'string'],
            'sibling_class' => ['nullable','required_if:sibling,'.AdmissionSiblingEnum::YES->value, 'string'],
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
