<?php

namespace App\Modules\Campaign\Campaign\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;


class CampaignCreateRequest extends FormRequest
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
            'slug' => 'required|string|max:500|unique:campaigns,slug',
            'heading' => 'required|string|max:500',
            'description' => 'required|string',
            'description_unfiltered' => 'required|string',
            'image' => 'required|image|min:1|max:5000',
            'image_alt' => 'nullable|string|max:500',
            'image_title' => 'nullable|string|max:500',
            'is_active' => 'required|boolean',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_scripts' => 'nullable|string',
            'include_topper' => 'required|boolean',
            'topper_heading' => ['nullable','required_if:include_topper,1', 'string'],
            'achiever' => 'nullable|required_if:include_topper,1|array|min:1',
            'achiever.*' => 'nullable|required_if:include_topper,1|numeric|exists:achivers,id',
            'include_testimonial' => 'required|boolean',
            'testimonial_heading' => ['nullable','required_if:include_testimonial,1', 'string'],
            'testimonial' => 'nullable|required_if:include_testimonial,1|array|min:1',
            'testimonial.*' => 'nullable|required_if:include_testimonial,1|numeric|exists:testimonials,id',
            'include_form' => 'required|boolean',
            'form_heading' => ['nullable','required_if:include_form,1', 'string'],
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
            'is_active' => 'Active',
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
