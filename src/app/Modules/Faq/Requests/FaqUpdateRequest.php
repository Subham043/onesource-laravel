<?php

namespace App\Modules\Faq\Requests;

class FaqUpdateRequest extends FaqCreateRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'answer_unfiltered' => 'required|string',
            'is_active' => 'required|boolean',
        ];
    }

}
