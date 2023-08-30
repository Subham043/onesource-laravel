<?php

namespace App\Modules\Blog\Requests;

use Illuminate\Support\Facades\Auth;

class BlogUpdateRequest extends BlogCreateRequest
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
            'author_name' => 'required|string|max:500',
            'published_on' => 'required|string|max:500',
            'slug' => 'required|string|max:500|unique:blogs,slug,'.$this->route('id'),
            'heading' => 'required|string|max:500',
            'description' => 'required|string',
            'description_unfiltered' => 'required|string',
            'image' => 'nullable|image|min:1|max:5000',
            'image_alt' => 'nullable|string|max:500',
            'image_title' => 'nullable|string|max:500',
            'is_active' => 'required|boolean',
            'is_popular' => 'required|boolean',
            'is_updated' => 'required|boolean',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_scripts' => 'nullable|string',
        ];
    }

}
