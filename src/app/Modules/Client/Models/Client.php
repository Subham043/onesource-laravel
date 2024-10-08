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
        'audio_phone',
        'encoder_phone',
        'mic_phone',
        'address',
        'notes',
        'line_placements',
        'word',
        'invoice_rate',
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

    public function documents()
    {
        return $this->hasMany(ClientDocument::class, 'client_id');
    }
}
