<?php

namespace App\Modules\Authentication\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Hash;
use App\Enums\Timezone;
use Illuminate\Auth\Events\Registered;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'timezone',
        'question_1',
        'answer_1',
        'question_2',
        'answer_2',
        'question_3',
        'answer_3',
        'is_blocked',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $append = [
        'current_role',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_blocked' => 'boolean',
        'timezone' => Timezone::class,
    ];

    protected $guard_name = 'web';

    public static function boot()
    {
        parent::boot();
        self::created(function ($user) {
            event(new Registered($user));
        });
        self::updated(function ($user) {});
        self::deleted(function ($user) {});
    }

    protected function currentRole(): Attribute
    {
        $roles_array = $this->getRoleNames();
        $currentRole = count($roles_array) > 0 ? $roles_array[0] : null;
        return Attribute::make(
            get: fn () => $currentRole,
        );
    }


    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Hash::make($value),
        );
    }

    /**
     * User Factory.
     *
     */
    protected static function newFactory(): Factory
    {
        return UserFactory::new();
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new \App\Modules\Authentication\Notifications\VerifyEmailQueued);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Modules\Authentication\Notifications\ResetPasswordQueued($token));
    }

    public function profiles()
    {
        return $this->hasMany(Profile::class, 'user_id');
    }

    public function members()
    {
        return $this->hasMany(Profile::class, 'created_by');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'paid_by');
    }

    public function staff_profile()
    {
        return $this->hasOne(Profile::class, 'user_id')->withDefault()->whereColumn('user_id', '<>', 'created_by');
    }

}
