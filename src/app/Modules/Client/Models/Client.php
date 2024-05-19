<?php

namespace App\Modules\Client\Models;

use App\Modules\Authentication\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'onsite_billing_rate',
        'remote_billing_rate',
        'setup_time',
        'address',
        'created_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'setup_time' => 'int',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by')->withDefault();
    }
}