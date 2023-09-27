<?php

namespace App\Modules\Course\Course\Models;

use App\Enums\CourseClass;
use App\Modules\Authentication\Models\User;
use App\Modules\Course\Branch\Models\Branch;
use App\Modules\Course\BranchDetail\Models\BranchDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;

class Course extends Model implements Sitemapable
{
    use HasFactory, LogsActivity;

    protected $table = 'courses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'description_unfiltered',
        'image',
        'image_alt',
        'image_title',
        'is_active',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_scripts',
        'class'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'class' => CourseClass::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $attributes = [
        'class' => CourseClass::NOT_PUC,
    ];

    public $image_path = 'courses';

    protected $appends = ['image_link'];

    public static function boot()
    {
        parent::boot();
        self::created(function ($model) {});
        self::updated(function ($model) {});
        self::deleted(function ($model) {});
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
            get: fn () => asset($this->image),
        );
    }

    protected function slug(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => str()->slug($value),
        );
    }

    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'course_join_branches', 'course_id', 'branch_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public function branch_details()
    {
        return $this->hasMany(BranchDetail::class, 'course_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('courses')
        ->setDescriptionForEvent(
                function(string $eventName){
                    $desc = "Course with name ".$this->name." has been {$eventName}";
                    $desc .= auth()->user() ? " by ".auth()->user()->name."<".auth()->user()->email.">" : "";
                    return $desc;
                }
            )
        ->logFillable()
        ->logOnlyDirty();
    }

    public function toSitemapTag(): Url | string | array
    {
        return route('courses_detail.get', $this->slug);
    }
}
