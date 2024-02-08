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
use App\Modules\Event\Models\EventWriter;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Builder;


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
        'image'
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
        'image_link'
    ];

    public $image_path = 'users';

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

    protected function image(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => 'storage/'.$this->image_path.'/'.$value,
        );
    }

    protected function imageLink(): Attribute
    {
        return new Attribute(
            get: fn () => $this->image ? asset($this->image) : asset('avatar.png'),
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

    public function self_profile()
    {
        return $this->hasOne(Profile::class, 'created_by')->withDefault()->where('created_by', auth()->user()->id)->whereColumn('user_id', 'created_by');
    }

    public function admin_profile()
    {
        return $this->hasOne(Profile::class, 'created_by')->withDefault()->where('created_by', auth()->user()->staff_member_profile->created_by)->whereColumn('user_id', 'created_by');
    }

    public function staff_member_profile()
    {
        return $this->hasOne(Profile::class, 'user_id')->withDefault()->where('user_id', auth()->user()->id)->whereColumn('user_id', '<>', 'created_by');
    }

    public function member_profile_created_by_auth()
    {
        return $this->hasOne(Profile::class, 'user_id')->withDefault()->whereColumn('user_id', '<>', 'created_by')->where('created_by', auth()->user()->current_role=='Staff-Admin' ? auth()->user()->staff_member_profile->created_by : auth()->user()->id);
    }

    public function cron_member_profile_created_by_auth()
    {
        return $this->hasOne(Profile::class, 'user_id')->withDefault()->whereColumn('user_id', '<>', 'created_by');
    }

    public function member_profile_not_created_by_auth()
    {
        return $this->hasOne(Profile::class, 'user_id')->withDefault()->whereColumn('user_id', '<>', 'created_by');
    }

    public function writerEvents()
    {
        return $this->hasMany(EventWriter::class, 'writer_id');
    }

    public function scopeFilterByRole(Builder $query, String $role): Builder
    {
        return $query->whereHas('roles', function($qry) use($role){
            $qry->where('name', $role);
        });
    }

    public function scopeFilterMemberCreatedByAuth(Builder $query): Builder
    {
        $qry = $query->with([
            'roles',
        ]);
        $qry->with([
            'member_profile_created_by_auth' => function($query){
                $query->with(['tools', 'client']);
            },
        ])->whereHas('member_profile_created_by_auth', function($qry){
            $qry->with(['tools', 'client'])->where('created_by', auth()->user()->current_role=='Staff-Admin' ? auth()->user()->staff_member_profile->created_by : auth()->user()->id);
        });
        return $qry;
    }

    public function scopeFilterMemberByRoleCreatedByAuth(Builder $query, String $role): Builder
    {
        return $query->filterMemberCreatedByAuth()->filterByRole($role);
    }

}
