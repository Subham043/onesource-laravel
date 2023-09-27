<?php

namespace App\Modules\Event\Event\Requests;

use Illuminate\Support\Facades\Auth;

class EventUpdateRequest extends EventCreateRequest
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
            'event_date' => 'required|string|max:500',
            'slug' => 'required|string|max:500|unique:events,slug,'.$this->route('id'),
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
            'speaker' => 'nullable|array|min:1',
            'speaker.*' => 'nullable|numeric|exists:event_speakers,id',
        ];
    }

}
