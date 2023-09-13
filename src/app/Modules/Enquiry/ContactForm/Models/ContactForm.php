<?php

namespace App\Modules\Enquiry\ContactForm\Models;

use App\Enums\Branch;
use App\Enums\RequestType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ContactForm extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'contact_form_enquiries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'course',
        'location',
        'branch',
        'request_type',
        'date',
        'time',
        'detail',
        'page_url',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'date' => 'datetime',
        'time' => 'datetime',
        'request_type' => RequestType::class,
        'branch' => Branch::class,
    ];

    protected $attributes = [
        'request_type' => RequestType::CALL_BACK,
        'branch' => Branch::VIJAYNAGAR,
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('contact form enquiries')
        ->setDescriptionForEvent(
                function(string $eventName){
                    $desc = "Contact form enquiry with user name ".$this->name." has been {$eventName}";
                    $desc .= auth()->user() ? " by ".auth()->user()->name."<".auth()->user()->email.">" : "";
                    return $desc;
                }
            )
        ->logFillable()
        ->logOnlyDirty();
        // Chain fluent methods for configuration options
    }
}
