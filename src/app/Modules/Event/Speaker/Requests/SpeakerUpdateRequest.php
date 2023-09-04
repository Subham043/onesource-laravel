<?php

namespace App\Modules\Event\Speaker\Requests;

use Illuminate\Support\Facades\Auth;

class SpeakerUpdateRequest extends SpeakerCreateRequest
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
            'designation' => 'nullable|string|max:250',
            'qualification' => 'nullable|string|max:250',
            'image' => 'nullable|image|min:1|max:500',
            'image_alt' => 'nullable|string|max:500',
            'image_title' => 'nullable|string|max:500',
        ];
    }

}
