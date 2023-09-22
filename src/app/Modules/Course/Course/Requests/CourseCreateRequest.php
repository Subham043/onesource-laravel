<?php

namespace App\Modules\Course\Course\Requests;

use App\Enums\CourseClass;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Validation\Rules\Enum;


class CourseCreateRequest extends FormRequest
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
            'name' => 'required|string|max:500',
            'slug' => 'required|string|max:500|unique:courses,slug',
            'description' => 'required|string',
            'description_unfiltered' => 'required|string',
            'image' => 'required|image|min:1|max:5000',
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
            'branch' => 'required|array|min:1',
            'branch.*' => 'required|numeric|exists:branches,id',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'is_active' => 'Active',
        ];
    }

    /**
     * Handle a passed validation attempt.
     *
     * @return void
     */
    protected function passedValidation()
    {
        $request = Purify::clean(
            $this->except(['meta_scripts'])
        );
        $this->replace(
            [...$request, ...$this->only(['meta_scripts'])]
        );
    }
}
