<?php

namespace App\Modules\Notification\Requests;

use App\Enums\DayType;
use App\Enums\RecurringInnerType;
use App\Enums\RecurringMonthInnerType;
use App\Enums\RecurringType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rule;


class NotificationRequest extends FormRequest
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
            'label' => 'required|string|max:500',

            //recurring type
            'recurring_type' => ['required', new Enum(RecurringType::class)],

            //recurring daily type
            'recurring_daily_type' => ['nullable', Rule::requiredIf($this->recurring_type==RecurringType::DAILY->value), new Enum(RecurringInnerType::class)],

            'recurring_daily_days' => ['nullable', Rule::requiredIf($this->recurring_type==RecurringType::DAILY->value && $this->recurring_daily_type==RecurringInnerType::FIRST->value), 'numeric', 'gt:0', 'lte:31'],

            //recurring weekly type
            'recurring_weekly_weeks' => ['nullable', Rule::requiredIf($this->recurring_type==RecurringType::WEEKLY->value), 'numeric', 'gt:0', 'lte:4'],

            'recurring_weekly_sunday' => ['nullable', Rule::requiredIf($this->recurring_type==RecurringType::WEEKLY->value), 'boolean'],

            'recurring_weekly_monday' => ['nullable', Rule::requiredIf($this->recurring_type==RecurringType::WEEKLY->value), 'boolean'],

            'recurring_weekly_tuesday' => ['nullable', Rule::requiredIf($this->recurring_type==RecurringType::WEEKLY->value), 'boolean'],

            'recurring_weekly_wednesday' => ['nullable', Rule::requiredIf($this->recurring_type==RecurringType::WEEKLY->value), 'boolean'],

            'recurring_weekly_thursday' => ['nullable', Rule::requiredIf($this->recurring_type==RecurringType::WEEKLY->value), 'boolean'],

            'recurring_weekly_friday' => ['nullable', Rule::requiredIf($this->recurring_type==RecurringType::WEEKLY->value), 'boolean'],

            'recurring_weekly_saturday' => ['nullable', Rule::requiredIf($this->recurring_type==RecurringType::WEEKLY->value), 'boolean'],

            //recurring monthly type
            'recurring_monthly_type' => ['nullable', Rule::requiredIf($this->recurring_type==RecurringType::MONTHLY->value), new Enum(RecurringInnerType::class)],

            'recurring_monthly_first_days' => ['nullable', Rule::requiredIf($this->recurring_type==RecurringType::MONTHLY->value && $this->recurring_monthly_type==RecurringInnerType::FIRST->value), 'numeric', 'gt:0', 'lte:31'],

            'recurring_monthly_first_months' => ['nullable', Rule::requiredIf($this->recurring_type==RecurringType::MONTHLY->value && $this->recurring_monthly_type==RecurringInnerType::FIRST->value), 'numeric', 'gt:0', 'lte:12'],

            'recurring_monthly_second_type' => ['nullable', Rule::requiredIf($this->recurring_type==RecurringType::MONTHLY->value && $this->recurring_monthly_type==RecurringInnerType::SECOND->value), new Enum(RecurringMonthInnerType::class)],

            'recurring_monthly_second_days' => ['nullable', Rule::requiredIf($this->recurring_type==RecurringType::MONTHLY->value && $this->recurring_monthly_type==RecurringInnerType::SECOND->value), new Enum(DayType::class)],

            'recurring_monthly_second_months' => ['nullable', Rule::requiredIf($this->recurring_type==RecurringType::MONTHLY->value && $this->recurring_monthly_type==RecurringInnerType::SECOND->value), 'numeric', 'gt:0', 'lte:12'],

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
