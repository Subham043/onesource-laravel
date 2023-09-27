<?php

namespace App\Modules\Course\BranchDetail\Models;

use App\Modules\Achiever\Student\Models\Student;
use App\Modules\Course\Branch\Models\Branch;
use App\Modules\Course\Course\Models\Course;
use App\Modules\TeamMember\Staff\Models\Staff;
use App\Modules\Testimonial\Models\Testimonial;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;

class BranchDetail extends Model implements Sitemapable
{
    use HasFactory, LogsActivity;

    protected $table = 'course_branch_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'description',
        'description_unfiltered',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_scripts',
        'amount',
        'discount',
        'include_testimonial',
        'testimonial_heading',
        'include_topper',
        'topper_heading',
        'include_staff',
        'staff_heading',
        'branch_id',
        'course_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'amount' => 'double',
        'discount' => 'int',
        'include_testimonial' => 'boolean',
        'include_topper' => 'boolean',
        'include_staff' => 'boolean',
    ];

    protected $attributes = [
        'amount' => 0.0,
        'discount' => 0,
    ];

    protected $appends = ['discounted_amount'];

    protected function discountedAmount(): Attribute
    {
        return new Attribute(
            get: fn () => round($this->amount - ($this->amount * ($this->discount/100)), 2),
        );
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id')->withDefault();
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id')->withDefault();
    }

    public function testimonials()
    {
        return $this->belongsToMany(Testimonial::class, 'branch_detail_join_testimonials', 'branch_detail_id', 'testimonial_id');
    }

    public function achievers()
    {
        return $this->belongsToMany(Student::class, 'branch_detail_join_achivers', 'branch_detail_id', 'achiever_id');
    }

    public function staffs()
    {
        return $this->belongsToMany(Staff::class, 'branch_detail_join_staffs', 'staff_id', 'branch_detail_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('course_branch_details')
        ->setDescriptionForEvent(
                function(string $eventName){
                    $desc = "Branch Detail has been {$eventName}";
                    $desc .= auth()->user() ? " by ".auth()->user()->name."<".auth()->user()->email.">" : "";
                    return $desc;
                }
            )
        ->logFillable()
        ->logOnlyDirty();
    }

    public function toSitemapTag(): Url | string | array
    {
        return route('course_branch_details_detail.get', $this->slug);
    }
}
