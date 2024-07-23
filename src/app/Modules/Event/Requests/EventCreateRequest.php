<?php

namespace App\Modules\Event\Requests;

use App\Enums\DayType;
use App\Enums\MonthType;
use App\Enums\RateType;
use App\Enums\RecurringInnerType;
use App\Enums\RecurringMonthInnerType;
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
                if($this->start_date==$this->end_date && $value == $this->start_time && $this->is_recurring_event==0){
                    $fail('The '.$attribute.' cannot be same as start time.');
                }
            }],
            'is_active' => 'required|boolean',
            'is_prep_ready' => 'required|boolean',
            'fuzion_id' => 'nullable|string|max:500',
            'is_recurring_event' => 'required|boolean',

            //recurring type
            'recurring_type' => ['nullable', 'required_if:is_recurring_event,1', new Enum(RecurringType::class)],

            'recurring_end_date' => ['nullable', 'required_if:is_recurring_event,1', 'date', 'after:start_date'],

            //recurring daily type
            'recurring_daily_type' => ['nullable', Rule::requiredIf($this->is_recurring_event==1 && $this->recurring_type==RecurringType::DAILY->value), new Enum(RecurringInnerType::class)],

            'recurring_daily_days' => ['nullable', Rule::requiredIf($this->is_recurring_event==1 && $this->recurring_type==RecurringType::DAILY->value && $this->recurring_daily_type==RecurringInnerType::FIRST->value), 'numeric', 'gt:0', 'lte:31'],

            //recurring weekly type
            'recurring_weekly_weeks' => ['nullable', Rule::requiredIf($this->is_recurring_event==1 && $this->recurring_type==RecurringType::WEEKLY->value), 'numeric', 'gt:0', 'lte:4'],

            'recurring_weekly_sunday' => ['nullable', Rule::requiredIf($this->is_recurring_event==1 && $this->recurring_type==RecurringType::WEEKLY->value), 'boolean'],

            'recurring_weekly_monday' => ['nullable', Rule::requiredIf($this->is_recurring_event==1 && $this->recurring_type==RecurringType::WEEKLY->value), 'boolean'],

            'recurring_weekly_tuesday' => ['nullable', Rule::requiredIf($this->is_recurring_event==1 && $this->recurring_type==RecurringType::WEEKLY->value), 'boolean'],

            'recurring_weekly_wednesday' => ['nullable', Rule::requiredIf($this->is_recurring_event==1 && $this->recurring_type==RecurringType::WEEKLY->value), 'boolean'],

            'recurring_weekly_thursday' => ['nullable', Rule::requiredIf($this->is_recurring_event==1 && $this->recurring_type==RecurringType::WEEKLY->value), 'boolean'],

            'recurring_weekly_friday' => ['nullable', Rule::requiredIf($this->is_recurring_event==1 && $this->recurring_type==RecurringType::WEEKLY->value), 'boolean'],

            'recurring_weekly_saturday' => ['nullable', Rule::requiredIf($this->is_recurring_event==1 && $this->recurring_type==RecurringType::WEEKLY->value), 'boolean'],

            //recurring monthly type
            'recurring_monthly_type' => ['nullable', Rule::requiredIf($this->is_recurring_event==1 && $this->recurring_type==RecurringType::MONTHLY->value), new Enum(RecurringInnerType::class)],

            'recurring_monthly_first_days' => ['nullable', Rule::requiredIf($this->is_recurring_event==1 && $this->recurring_type==RecurringType::MONTHLY->value && $this->recurring_monthly_type==RecurringInnerType::FIRST->value), 'numeric', 'gt:0', 'lte:31'],

            'recurring_monthly_first_months' => ['nullable', Rule::requiredIf($this->is_recurring_event==1 && $this->recurring_type==RecurringType::MONTHLY->value && $this->recurring_monthly_type==RecurringInnerType::FIRST->value), 'numeric', 'gt:0', 'lte:12'],

            'recurring_monthly_second_type' => ['nullable', Rule::requiredIf($this->is_recurring_event==1 && $this->recurring_type==RecurringType::MONTHLY->value && $this->recurring_monthly_type==RecurringInnerType::SECOND->value), new Enum(RecurringMonthInnerType::class)],

            'recurring_monthly_second_days' => ['nullable', Rule::requiredIf($this->is_recurring_event==1 && $this->recurring_type==RecurringType::MONTHLY->value && $this->recurring_monthly_type==RecurringInnerType::SECOND->value), new Enum(DayType::class)],

            'recurring_monthly_second_months' => ['nullable', Rule::requiredIf($this->is_recurring_event==1 && $this->recurring_type==RecurringType::MONTHLY->value && $this->recurring_monthly_type==RecurringInnerType::SECOND->value), 'numeric', 'gt:0', 'lte:12'],

            //recurring yearly type
            'recurring_yearly_months' => ['nullable', Rule::requiredIf($this->is_recurring_event==1 && $this->recurring_type==RecurringType::YEARLY->value), new Enum(MonthType::class)],

            'recurring_yearly_days' => ['nullable', Rule::requiredIf($this->is_recurring_event==1 && $this->recurring_type==RecurringType::YEARLY->value), 'numeric', 'gt:0', 'lte:31'],

            'client' => [
                'required',
                'numeric',
                'exists:clients,id',
            ],
            'rate_type' => ['required', new Enum(RateType::class)],
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
