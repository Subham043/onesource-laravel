<?php

namespace App\Modules\Course\Branch\Models;

use App\Modules\Authentication\Models\User;
use App\Modules\Course\BranchDetail\Models\BranchDetail;
use App\Modules\Course\Course\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;

class Branch extends Model implements Sitemapable
{
    use HasFactory, LogsActivity;

    protected $table = 'branches';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();
        self::created(function ($model) {});
        self::updated(function ($model) {});
        self::deleted(function ($model) {});
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

    public function branch_details()
    {
        return $this->hasMany(BranchDetail::class, 'branch_id');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_join_branches', 'branch_id', 'course_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('branches')
        ->setDescriptionForEvent(
                function(string $eventName){
                    $desc = "Branch with name ".$this->name." has been {$eventName}";
                    $desc .= auth()->user() ? " by ".auth()->user()->name."<".auth()->user()->email.">" : "";
                    return $desc;
                }
            )
        ->logFillable()
        ->logOnlyDirty();
    }

    public function toSitemapTag(): Url | string | array
    {
        return route('branches_detail.get', $this->slug);
    }
}
