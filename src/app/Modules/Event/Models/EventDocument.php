<?php

namespace App\Modules\Event\Models;

use App\Modules\Authentication\Models\User;
use App\Modules\Document\Models\DocumentNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Builder;

class EventDocument extends Model
{
    use HasFactory;

    protected $table = 'event_documents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'document',
        'event_id',
        'created_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $document_path = 'documents';

    protected $appends = ['document_link'];

    public static function boot(): void
    {
        parent::boot();
        static::created(fn (Model $model) =>
            DocumentNotification::create([
                'event_document_id' => $model->id
            ]),
        );
    }

    protected function document(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => 'storage/'.$this->document_path.'/'.$value,
        );
    }

    protected function documentLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset($this->document),
        );
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by')->withDefault();
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id')->withDefault();
    }

    public function scopeFilterByRoles(Builder $query): Builder
    {
        $query_builder = $query->with([
            'event'=> function($qry){
                if(auth()->user()->current_role=='Writer'){
                    $qry->with([
                        'writers'=> function($qry){
                            $qry->with('writer')->where('writer_id', auth()->user()->id);
                        },
                        'documents',
                        'client'
                    ]);
                }elseif(auth()->user()->current_role=='Client'){
                    $qry->with([
                        'writers'=> function($qry){
                            $qry->with('writer');
                        },
                        'documents',
                        'client'
                    ]);
                }else{
                    $qry->with([
                        'writers'=> function($qry){
                            $qry->with('writer');
                        },
                        'documents',
                        'client'
                    ])->where('created_by', auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id);
                }
            },
            'creator'
        ]);
        if(auth()->user()->current_role=='Writer'){
            $query_builder->whereHas('event', function($qr){
                $qr->whereHas('writers', function($qry){
                    $qry->where('writer_id', auth()->user()->id);
                });
            });
        }elseif(auth()->user()->current_role=='Client'){
            $query_builder->whereHas('event', function($qr){
                $qr->whereHas('client', function($qry){
                    $qry->whereIn('id', auth()->user()->profiles->pluck('client_id')->filter());
                });
            });
        }else{
            $query_builder->whereHas('event', function($qry){
                $qry->where('created_by', auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id);
            });
        }
        return $query_builder;
    }
}
