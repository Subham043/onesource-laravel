<?php

namespace App\Modules\TeamMember\Management\Requests;

use Illuminate\Support\Facades\Auth;

class ManagementUpdateRequest extends ManagementCreateRequest
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
            'designation' => 'required|string|max:250',
            'qualification' => 'required|string|max:250',
            'description' => 'required|string',
            'description_unfiltered' => 'required|string',
            'image' => 'nullable|image|max:500',
            'image_alt' => 'nullable|string|max:500',
            'image_title' => 'nullable|string|max:500',
            'is_active' => 'required|boolean',
        ];
    }

}
