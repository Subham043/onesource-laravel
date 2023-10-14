<?php

namespace App\Modules\Event\Models;

use App\Enums\RecurringType;
use App\Modules\Authentication\Models\User;
use App\Modules\Client\Models\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'invoice_rate',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'is_recurring_event',
        'recurring_type',
        'recurring_days',
        'recurring_end_date',
        'notes',
        'client_id',
        'created_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'recurring_end_date' => 'datetime',
        'is_recurring_event' => 'boolean',
        'recurring_type' => RecurringType::class,
    ];

    protected $attributes = [
        'recurring_type' => RecurringType::DAILY,
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by')->withDefault();
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id')->withDefault();
    }

    public function writers()
    {
        return $this->hasMany(EventWriter::class, 'event_id');
    }

    public function documents()
    {
        return $this->hasMany(EventDocument::class, 'event_id');
    }
}
