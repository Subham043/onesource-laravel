<?php

namespace App\Modules\Event\Requests;

use App\Enums\RecurringType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rule;


class EventUpdateRequest extends FormRequest
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
            'start_date' => 'required|string',
            'end_date' => 'required|string',
            'start_time' => 'required|string',
            'end_time' => 'required|string',
            'is_recurring_event' => 'required|boolean',
            'recurring_type' => ['nullable', 'required_if:is_recurring_event,1', new Enum(RecurringType::class)],
            'recurring_days' => ['nullable', Rule::requiredIf($this->is_recurring_event==1 && $this->recurring_type=='Every'),'numeric','gte:0'],
            'recurring_end_date' => 'nullable|required_if:is_recurring_event,1|string',
            'client' => [
                'required',
                'numeric',
                'exists:clients,id',
            ],
            'notes' => 'nullable|string',
            'writer_ids' => ['required', 'array', 'min:1'],
            'writer_ids.*' => [
                'required',
                'numeric',
                'exists:users,id',
            ],
            'billing_rates' => ['required', 'array', 'min:1'],
            'billing_rates.*' => [
                'required',
                'numeric',
                'gte:0',
            ],
            'documents' => ['nullable', 'array', 'min:1'],
            'documents.*' => 'required|mimes:pdf,doc,docx,dot,xls,xlsx,ppt,pptx,pps|max:5000',
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
