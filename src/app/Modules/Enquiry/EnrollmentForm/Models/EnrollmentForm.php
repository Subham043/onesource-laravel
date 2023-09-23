<?php

namespace App\Modules\Enquiry\EnrollmentForm\Models;

use App\Enums\PaymentStatus;
use App\Modules\Course\Branch\Models\Branch;
use App\Modules\Course\Course\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class EnrollmentForm extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'course_enrollments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'amount',
        'discount',
        'discounted_amount',
        'receipt',
        'payment_status',
        'razorpay_signature',
        'razorpay_order_id',
        'razorpay_payment_id',
        'course_id',
        'branch_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'amount' => 'double',
        'discounted_amount' => 'double',
        'discount' => 'int',
        'payment_status' => PaymentStatus::class,
    ];

    protected $attributes = [
        'payment_status' => PaymentStatus::PENDING,
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id')->withDefault();
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id')->withDefault();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('enrollment form enquiries')
        ->setDescriptionForEvent(
                function(string $eventName){
                    $desc = "Enrollment form enquiry with user name ".$this->name." has been {$eventName}";
                    $desc .= auth()->user() ? " by ".auth()->user()->name."<".auth()->user()->email.">" : "";
                    return $desc;
                }
            )
        ->logFillable()
        ->logOnlyDirty();
        // Chain fluent methods for configuration options
    }
}
