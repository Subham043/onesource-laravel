<?php

namespace App\Modules\User\Requests;

use App\Enums\Timezone;
use App\Modules\Authentication\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Validation\Rules\Password as PasswordValidation;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rule;


class UserCreatePostRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'email' => ['required','email:rfc,dns', function ($attribute, $value, $fail) {
                if($value==auth()->user()->email){
                    $fail('The '.$attribute.' entered is already taken.');
                }
                $user_count = User::where('email', $value)->first();
                if(!empty($user_count)){
                    if($user_count->current_role=='Super-Admin' || $user_count->current_role=='Admin' || $user_count->current_role=='Staff-Admin'){
                        $fail('The '.$attribute.' entered is already taken.');
                    }
                    $user_check_count = $user_count->with([
                        'member_profile_created_by_auth' => function($query){
                            $query->where('created_by', auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id)->whereHas('user', function($qr){
                                $qr->where('email', $this->email);
                            });
                        },
                    ])->whereHas('member_profile_created_by_auth', function($qry){
                        $qry->where('created_by', auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id)->whereHas('user', function($qr){
                            $qr->where('email', $this->email);
                        });
                    })->first();
                    if(!empty($user_check_count)){
                        $fail('The '.$attribute.' entered is already taken.');
                    }
                }
            }],
            'phone' => ['required','numeric', 'gt:0', function ($attribute, $value, $fail) {
                if($value==auth()->user()->phone){
                    $fail('The '.$attribute.' entered is already taken.');
                }
                $user_count = User::where('phone', $value)->first();
                if(!empty($user_count)){
                    if($user_count->current_role=='Super-Admin' || $user_count->current_role=='Admin' || $user_count->current_role=='Staff-Admin'){
                        $fail('The '.$attribute.' entered is already taken.');
                    }
                    $user_check_count = $user_count->with([
                        'member_profile_created_by_auth' => function($query){
                            $query->where('created_by', auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id)->whereHas('user', function($qr){
                                $qr->where('phone', $this->phone);
                            });
                        },
                    ])->whereHas('member_profile_created_by_auth', function($qry){
                        $qry->where('created_by', auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id)->whereHas('user', function($qr){
                            $qr->where('phone', $this->phone);
                        });
                    })->first();
                    if(!empty($user_check_count)){
                        $fail('The '.$attribute.' entered is already taken.');
                    }
                }
            }],
            'password' => ['required',
                'string',
                PasswordValidation::min(8)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                        ->uncompromised()
            ],
            'confirm_password' => ['required_with:password','same:password'],
            'timezone' => ['required', new Enum(Timezone::class)],
            'role' => ['required', 'string', 'in:Staff-Admin,Client,Writer', 'exists:Spatie\Permission\Models\Role,name'],
            'billing_rate' => ['nullable', Rule::requiredIf($this->role==='Client' || $this->role==='Writer'), 'numeric', 'gt:0'],
            'tool' => ['nullable', Rule::excludeIf($this->role!=='Writer'), 'array', 'min:1'],
            'tool.*' => ['nullable', Rule::excludeIf($this->role!=='Writer'), 'numeric', 'exists:App\Modules\Tool\Models\Tool,id'],
            'client' => ['nullable', Rule::requiredIf($this->role==='Client'), 'exists:App\Modules\Client\Models\Client,id'],
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
