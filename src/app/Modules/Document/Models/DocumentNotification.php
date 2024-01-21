<?php

namespace App\Modules\Document\Models;

use App\Modules\Event\Models\Event;
use App\Modules\Event\Models\EventDocument;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class DocumentNotification extends Model
{
    use HasFactory;

    protected $table = 'document_notifications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'event_document_id',
        'created_event_id',
        'updated_event_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function document()
    {
        return $this->belongsTo(EventDocument::class, 'event_document_id')->withDefault();
    }

    public function created_event()
    {
        return $this->belongsTo(Event::class, 'created_event_id')->withDefault();
    }

    public function updated_event()
    {
        return $this->belongsTo(Event::class, 'updated_event_id')->withDefault();
    }

    public function scopeFilterByRoles(Builder $query_builder): Builder
    {
        // $query_builder = $query->with([
        //     'document' => function($q){
        //         $q->with([
        //             'event'=> function($qry){
        //                 if(auth()->user()->current_role=='Writer'){
        //                     $qry->with([
        //                         'writers'=> function($qry){
        //                             $qry->with('writer')->where('writer_id', auth()->user()->id);
        //                         },
        //                         'documents',
        //                         'client'
        //                     ]);
        //                 }elseif(auth()->user()->current_role=='Client'){
        //                     $qry->with([
        //                         'writers'=> function($qry){
        //                             $qry->with('writer');
        //                         },
        //                         'documents',
        //                         'client'
        //                     ]);
        //                 }else{
        //                     $qry->with([
        //                         'writers'=> function($qry){
        //                             $qry->with('writer');
        //                         },
        //                         'documents',
        //                         'client'
        //                     ])->where('created_by', auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id);
        //                 }
        //             },
        //             'creator'
        //         ]);
        //     },
        //     'created_event' => function($q){
        //         if($this->created_event_id){
        //             if(auth()->user()->current_role=='Writer'){
        //                 $q->with([
        //                     'writers'=> function($qry){
        //                         $qry->with('writer')->where('writer_id', auth()->user()->id);
        //                     },
        //                     'documents',
        //                     'client'
        //                 ]);
        //             }elseif(auth()->user()->current_role=='Client'){
        //                 $q->with([
        //                     'writers'=> function($qry){
        //                         $qry->with('writer');
        //                     },
        //                     'documents',
        //                     'client'
        //                 ]);
        //             }else{
        //                 $q->with([
        //                     'writers'=> function($qry){
        //                         $qry->with('writer');
        //                     },
        //                     'documents',
        //                     'client'
        //                 ])->where('created_by', auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id);
        //             }
        //         }
        //     },
        //     'updated_event' => function($q){
        //         if($this->updated_event_id){
        //             if(auth()->user()->current_role=='Writer'){
        //                 $q->with([
        //                     'writers'=> function($qry){
        //                         $qry->with('writer')->where('writer_id', auth()->user()->id);
        //                     },
        //                     'documents',
        //                     'client'
        //                 ]);
        //             }elseif(auth()->user()->current_role=='Client'){
        //                 $q->with([
        //                     'writers'=> function($qry){
        //                         $qry->with('writer');
        //                     },
        //                     'documents',
        //                     'client'
        //                 ]);
        //             }else{
        //                 $q->with([
        //                     'writers'=> function($qry){
        //                         $qry->with('writer');
        //                     },
        //                     'documents',
        //                     'client'
        //                 ])->where('created_by', auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id);
        //             }
        //         }
        //     },
        // ]);
        if(auth()->user()->current_role=='Writer'){
            $query_builder->where(function($qrry){
                $qrry->with([
                    'document',
                    'created_event',
                    'updated_event',
                ])->orWhereHas('document', function($q){
                    $q->whereHas('event', function($qr){
                        $qr->whereHas('writers', function($qry){
                            $qry->where('writer_id', auth()->user()->id);
                        });
                    });
                })->orWhereHas('created_event', function($q){
                    $q->whereHas('writers', function($qry){
                        $qry->where('writer_id', auth()->user()->id);
                    });
                })->orWhereHas('updated_event', function($q){
                    $q->whereHas('writers', function($qry){
                        $qry->where('writer_id', auth()->user()->id);
                    });
                });
            });
        }elseif(auth()->user()->current_role=='Client'){
            $query_builder->where(function($qrry){
                $qrry->with([
                    'document',
                    'created_event',
                    'updated_event',
                ])->orWhereHas('document', function($q){
                    $q->whereHas('event', function($qr){
                        $qr->whereHas('client', function($qry){
                            $qry->whereIn('id', auth()->user()->profiles->pluck('client_id')->filter());
                        });
                    });
                })->orWhereHas('created_event', function($q){
                    $q->whereHas('client', function($qry){
                        $qry->whereIn('id', auth()->user()->profiles->pluck('client_id')->filter());
                    });
                })->orWhereHas('updated_event', function($q){
                    $q->whereHas('client', function($qry){
                        $qry->whereIn('id', auth()->user()->profiles->pluck('client_id')->filter());
                    });
                });
            });
        }else{
            $query_builder->where(function($qrry){
                $qrry->with([
                    'document',
                    'created_event',
                    'updated_event',
                ])->orWhereHas('document', function($q){
                    $q->whereHas('event', function($qry){
                        $qry->where('created_by', auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id);
                    });
                })->orWhereHas('created_event', function($q){
                    $q->where('created_by', auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id);
                })->orWhereHas('updated_event', function($q){
                    $q->where('created_by', auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id);
                });
            });
        }
        return $query_builder;
    }
}
