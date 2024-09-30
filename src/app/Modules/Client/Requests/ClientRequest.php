<?php

namespace App\Modules\Client\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;


class ClientRequest extends FormRequest
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
            'email' => ['required','email:rfc,dns'],
            'phone' => ['required','regex:/(^[0-9 \+\-\(\)]+$)+/'],
            'audio_phone' => ['nullable','regex:/(^[0-9 \+\-\(\)]+$)+/'],
            'encoder_phone' => ['nullable','regex:/(^[0-9 \+\-\(\)]+$)+/'],
            'mic_phone' => ['nullable','regex:/(^[0-9 \+\-\(\)]+$)+/'],
            'invoice_rate' => ['required', 'numeric', 'gte:0'],
            // 'onsite_billing_rate' => ['required', 'numeric', 'gte:0'],
            // 'remote_billing_rate' => ['required', 'numeric', 'gte:0'],
            // 'setup_time' => ['required', 'numeric', 'gte:0'],
            'address' => 'required|string',
            'notes' => 'nullable|string',
            'line_placements' => 'nullable|string',
            'word' => 'nullable|string',
            'documents' => ['nullable', 'array', 'min:1'],
            'documents.*' => 'required|mimes:pdf,doc,docx,dot,xls,xlsx,ppt,pptx,pps,jpg,jpeg,png,webp,rtf,text|max:5000',
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
