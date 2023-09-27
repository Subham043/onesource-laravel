<?php

namespace App\Modules\Course\BranchDetail\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;


class BranchDetailRequest extends FormRequest
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
            'description' => 'required|string',
            'description_unfiltered' => 'required|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_scripts' => 'nullable|string',
            'amount' => 'required|numeric|gt:0',
            'discount' => 'required|numeric|gte:0',
            'include_topper' => 'required|boolean',
            'topper_heading' => ['nullable','required_if:include_topper,1', 'string'],
            'achiever' => 'nullable|required_if:include_topper,1|array|min:1',
            'achiever.*' => 'nullable|required_if:include_topper,1|numeric|exists:achivers,id',
            'include_testimonial' => 'required|boolean',
            'testimonial_heading' => ['nullable','required_if:include_testimonial,1', 'string'],
            'testimonial' => 'nullable|required_if:include_testimonial,1|array|min:1',
            'testimonial.*' => 'nullable|required_if:include_testimonial,1|numeric|exists:testimonials,id',
            'include_staff' => 'required|boolean',
            'staff_heading' => ['nullable','required_if:include_staff,1', 'string'],
            'staff' => 'nullable|required_if:include_staff,1|array|min:1',
            'staff.*' => 'nullable|required_if:include_staff,1|numeric|exists:team_member_staffs,id',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'is_draft' => 'Draft',
        ];
    }

    /**
     * Handle a passed validation attempt.
     *
     * @return void
     */
    protected function passedValidation()
    {
        $request = Purify::clean(
            $this->except(['meta_scripts'])
        );
        $this->replace(
            [...$request, ...$this->only(['meta_scripts'])]
        );
    }
}
