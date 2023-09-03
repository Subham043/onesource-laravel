<?php

namespace App\Modules\Achiever\Category\Requests;

use Illuminate\Support\Facades\Auth;

class CategoryUpdateRequest extends CategoryCreateRequest
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
            'slug' => 'required|string|max:500|unique:achivers_categories,slug,'.$this->route('id'),
            'heading' => 'required|string|max:500',
            'description' => 'required|string',
            'is_active' => 'required|boolean',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_scripts' => 'nullable|string',
        ];
    }

}
