<?php

namespace App\Modules\Notification\Models;

use App\Modules\Authentication\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Builder;

class Template extends Model
{
    use HasFactory;

    protected $table = 'notification_templates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'logo',
        'footer',
        'created_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $logo_path = 'notification_templates';

    protected $appends = ['logo_link'];

    protected function logo(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => 'storage/'.$this->logo_path.'/'.$value,
        );
    }

    protected function logoLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset($this->logo),
        );
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by')->withDefault();
    }

    public function scopeFilterByRoles(Builder $query): Builder
    {
        $query_builder = $query->where('created_by', auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id);
        return $query_builder;
    }
}
