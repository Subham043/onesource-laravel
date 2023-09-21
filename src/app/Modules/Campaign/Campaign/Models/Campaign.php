<?php

namespace App\Modules\Campaign\Campaign\Models;

use App\Modules\Achiever\Student\Models\Student;
use App\Modules\Authentication\Models\User;
use App\Modules\Event\Speaker\Models\Speaker;
use App\Modules\Event\Specification\Models\Specification;
use App\Modules\Testimonial\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;

class Campaign extends Model implements Sitemapable
{
    use HasFactory, LogsActivity;

    protected $table = 'campaigns';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'heading',
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
        'include_testimonial',
        'testimonial_heading',
        'include_topper',
        'topper_heading',
        'include_form',
        'form_heading',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'include_testimonial' => 'boolean',
        'include_topper' => 'boolean',
        'include_form' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $image_path = 'campaigns';

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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public function enquiries()
    {
        return $this->hasMany(Specification::class, 'campaign_id');
    }

    public function testimonials()
    {
        return $this->belongsToMany(Testimonial::class, 'campaign_join_testimonials', 'campaign_id', 'testimonial_id');
    }

    public function achievers()
    {
        return $this->belongsToMany(Student::class, 'campaign_join_achivers', 'campaign_id', 'achiver_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('campaigns')
        ->setDescriptionForEvent(
                function(string $eventName){
                    $desc = "Campaign with name ".$this->name." has been {$eventName}";
                    $desc .= auth()->user() ? " by ".auth()->user()->name."<".auth()->user()->email.">" : "";
                    return $desc;
                }
            )
        ->logFillable()
        ->logOnlyDirty();
    }

    public function toSitemapTag(): Url | string | array
    {
        return route('campaigns_detail.get', $this->slug);
    }
}
