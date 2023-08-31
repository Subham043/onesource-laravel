<?php

namespace App\Modules\ExpertTip\Models;

use App\Modules\Authentication\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;

class ExpertTip extends Model implements Sitemapable
{
    use HasFactory, LogsActivity;

    protected $table = 'expert_tips';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'author_name',
        'slug',
        'heading',
        'description',
        'description_unfiltered',
        'is_active',
        'is_popular',
        'is_updated',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_scripts',
        'published_on',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_popular' => 'boolean',
        'is_updated' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'published_on' => 'date',
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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('expert_tips')
        ->setDescriptionForEvent(
                function(string $eventName){
                    $desc = "Expert Tip with name ".$this->name." has been {$eventName}";
                    $desc .= auth()->user() ? " by ".auth()->user()->name."<".auth()->user()->email.">" : "";
                    return $desc;
                }
            )
        ->logFillable()
        ->logOnlyDirty();
    }

    public function toSitemapTag(): Url | string | array
    {
        return route('expert_tips_detail.get', $this->slug);
    }
}
