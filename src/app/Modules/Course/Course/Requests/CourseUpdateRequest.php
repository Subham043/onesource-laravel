<?php

namespace App\Modules\Course\Course\Requests;

use App\Enums\CourseClass;
use Illuminate\Validation\Rules\Enum;

class CourseUpdateRequest extends CourseCreateRequest
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
            'slug' => 'required|string|max:500|unique:courses,slug,'.$this->route('id'),
            'description' => 'required|string',
            'description_unfiltered' => 'required|string',
            'image' => 'nullable|image|min:1|max:5000',
            'image_alt' => 'nullable|string|max:500',
            'image_title' => 'nullable|string|max:500',
            'amount' => 'required|numeric|gt:0',
            'discount' => 'required|numeric|gte:0',
            'class' => ['required', new Enum(CourseClass::class)],
            'is_active' => 'required|boolean',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_scripts' => 'nullable|string',
        ];
    }

}
