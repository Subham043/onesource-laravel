<?php

namespace App\Modules\Authentication\Models;

use App\Enums\State;
use App\Modules\Authentication\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profile_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company',
        'address',
        'city',
        'state',
        'zip',
        'website',
        'is_primary_user',
        'billing_rate',
        'user_id',
        'created_by',
    ];

    protected $casts = [
        'is_primary_user' => 'boolean',
        'state' => State::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by')->withDefault();
    }

}
