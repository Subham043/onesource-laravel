<?php

namespace App\Modules\Notification\Requests;

use App\Enums\NotificationType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rule;


class SendNotificationRequest extends FormRequest
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
            'notificationType' => ['required', new Enum(NotificationType::class)],

            'client' => [
                'nullable',
                Rule::requiredIf($this->notificationType==NotificationType::CLIENT->value),
                'numeric',
                'exists:clients,id',
            ],

            'writer' => [
                'nullable',
                Rule::requiredIf($this->notificationType==NotificationType::WRITER->value),
                'numeric',
                'exists:users,id',
            ],

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
