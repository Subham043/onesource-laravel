<?php

namespace App\Modules\Campaign\Campaign\Requests;

use Illuminate\Support\Facades\Auth;

class CampaignUpdateRequest extends CampaignCreateRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:500',
            'slug' => 'required|string|max:500|unique:campaigns,slug,'.$this->route('id'),
            'heading' => 'required|string|max:500',
            'description' => 'required|string',
            'description_unfiltered' => 'required|string',
            'image' => 'nullable|image|min:1|max:5000',
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

}
