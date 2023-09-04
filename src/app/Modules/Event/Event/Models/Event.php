<?php

namespace App\Modules\Event\Event\Models;

use App\Modules\Authentication\Models\User;
use App\Modules\Event\Speaker\Models\Speaker;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;

class Event extends Model implements Sitemapable
{
    use HasFactory, LogsActivity;

    protected $table = 'events';

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
        'event_date',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_popular' => 'boolean',
        'is_updated' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'event_date' => 'date',
    ];

    public $image_path = 'events';

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

    public function speakers()
    {
        return $this->belongsToMany(Speaker::class, 'event_join_speakers', 'event_id', 'speaker_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('events')
        ->setDescriptionForEvent(
                function(string $eventName){
                    $desc = "Event with name ".$this->name." has been {$eventName}";
                    $desc .= auth()->user() ? " by ".auth()->user()->name."<".auth()->user()->email.">" : "";
                    return $desc;
                }
            )
        ->logFillable()
        ->logOnlyDirty();
    }

    public function toSitemapTag(): Url | string | array
    {
        return route('events_detail.get', $this->slug);
    }
}
