<?php

namespace App\Modules\Course\Branch\Requests;


class BranchUpdateRequest extends BranchCreateRequest
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
            'slug' => 'required|string|max:500|unique:branches,slug,'.$this->route('id'),
            'is_active' => 'required|boolean',
        ];
    }

}
