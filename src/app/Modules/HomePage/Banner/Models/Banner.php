<?php

namespace App\Modules\HomePage\Banner\Models;

use App\Modules\Authentication\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Banner extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'home_page_banners';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'heading',
        'button_link',
        'button_text',
        'banner_image',
        'banner_image_alt',
        'banner_image_title',
        'description',
        'counter_title_1',
        'counter_description_1',
        'counter_image_1',
        'counter_title_2',
        'counter_description_2',
        'counter_image_2',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $image_path = 'home_page_banners';

    protected $appends = ['banner_image_url', 'counter_image_one_link', 'counter_image_two_link'];

    public static function boot()
    {
        parent::boot();
        self::created(function ($model) {});
        self::updated(function ($model) {});
        self::deleted(function ($model) {});
    }

    protected function bannerImage(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => 'storage/'.$this->image_path.'/'.$value,
        );
    }

    protected function bannerImageUrl(): Attribute
    {
        return new Attribute(
            get: fn () => asset($this->banner_image),
        );
    }

    protected function counterImage1(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => 'storage/'.$this->image_path.'/'.$value,
        );
    }

    protected function counterImageOneLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset($this->counter_image_1),
        );
    }

    protected function counterImage2(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => 'storage/'.$this->image_path.'/'.$value,
        );
    }

    protected function counterImageTwoLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset($this->counter_image_2),
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('home page banner')
        ->setDescriptionForEvent(
                function(string $eventName){
                    $desc = "Home page banner with title ".$this->title." has been {$eventName}";
                    $desc .= auth()->user() ? " by ".auth()->user()->name."<".auth()->user()->email.">" : "";
                    return $desc;
                }
            )
        ->logFillable()
        ->logOnlyDirty();
        // Chain fluent methods for configuration options
    }

}
