<?php

namespace App\Modules\Event\Requests;

use App\Enums\RecurringType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rule;


class EventCreateRequest extends FormRequest
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
            'invoice_rate' => 'required|numeric|gte:0',
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'start_time' => ['required', 'string'],
            'end_time' => ['required', 'string', function ($attribute, $value, $fail) {
                if($this->start_date==$this->end_date && $value == $this->start_time){
                    $fail('The '.$attribute.' cannot be same as start time.');
                }
            }],
            'is_active' => 'required|boolean',
            'is_prep_ready' => 'required|boolean',
            'fuzion_id' => 'nullable|string|max:500',
            'is_recurring_event' => 'required|boolean',
            'recurring_type' => ['nullable', 'required_if:is_recurring_event,1', new Enum(RecurringType::class)],
            'recurring_days' => ['nullable', Rule::requiredIf($this->is_recurring_event==1 && $this->recurring_type=='Every'),'numeric','gte:0'],
            'recurring_end_date' => ['nullable', 'required_if:is_recurring_event,1', 'date', 'after:start_date'],
            'client' => [
                'required',
                'numeric',
                'exists:clients,id',
            ],
            'notes' => 'nullable|string',
            'writer_ids' => ['nullable', 'array', 'min:1'],
            'writer_ids.*' => [
                'required',
                'numeric',
                'exists:users,id',
            ],
            'billing_rates' => ['nullable', 'array', 'min:1'],
            'billing_rates.*' => [
                'required',
                'numeric',
                'gte:0',
            ],
            'documents' => ['nullable', 'array', 'min:1'],
            'documents.*' => 'required|mimes:pdf,doc,docx,dot,xls,xlsx,ppt,pptx,pps,jpg,jpeg,png,webp|max:5000',
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
            'documents.*' => 'Document',
            'writer_ids.*' => 'Writer',
            'billing_rates.*' => 'Billing Rate',
        ];
    }

    /**
     * Handle a passed validation attempt.
     *
     * @return void
     */
    protected function passedValidation()
    {
        $this->replace(
            Purify::clean(
                $this->all()
            )
        );
    }
}
