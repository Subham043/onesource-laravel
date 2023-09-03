<?php

namespace App\Modules\Achiever\Student\Requests;

use Illuminate\Support\Facades\Auth;

class StudentUpdateRequest extends StudentCreateRequest
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
            'name' => 'required|string|max:250',
            'rank' => 'nullable|string|max:250',
            'college' => 'nullable|string|max:250',
            'category' => 'required|array|min:1',
            'category.*' => 'required|numeric|exists:achivers_categories,id',
            'image' => 'nullable|image|min:1|max:500',
            'image_alt' => 'nullable|string|max:500',
            'image_title' => 'nullable|string|max:500',
            'is_active' => 'required|boolean',
        ];
    }

}
