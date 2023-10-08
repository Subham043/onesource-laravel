<?php

namespace App\Modules\Tool\Models;

use App\Modules\Authentication\Models\Profile;
use App\Modules\Authentication\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    use HasFactory;

    protected $table = 'tools';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'created_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by')->withDefault();
    }

    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'user_tools', 'tool_id', 'profile_detail_id');
    }
}
