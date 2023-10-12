<?php

namespace App\Modules\Event\Models;

use App\Modules\Authentication\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventWriter extends Model
{
    use HasFactory;

    protected $table = 'event_writers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'billing_rate',
        'writer_id',
        'event_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'billing_rate' => 'int',
    ];

    public function writer()
    {
        return $this->belongsTo(User::class, 'writer_id')->withDefault();
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id')->withDefault();
    }
}
