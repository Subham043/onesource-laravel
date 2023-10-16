<?php

namespace App\Modules\Document\Services;

use App\Http\Services\FileService;
use App\Modules\Event\Models\Event;
use App\Modules\Event\Models\EventDocument;
use App\Modules\Document\Requests\DocumentCreateRequest;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class DocumentService
{

    public function all(): Collection
    {
        $query = EventDocument::with([
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
        ]);
        if(auth()->user()->current_role=='Writer'){
            $query->whereHas('event', function($qr){
                $qr->whereHas('writers', function($qry){
                    $qry->where('writer_id', auth()->user()->id);
                });
            });
        }elseif(auth()->user()->current_role=='Client'){

        }else{
            $query->whereHas('event', function($qry){
                $qry->where('created_by', auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id);
            });
        }
        $data = $query->get();
        return $data;
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = EventDocument::with([
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
            $query->whereHas('event', function($qr){
                $qr->whereHas('writers', function($qry){
                    $qry->where('writer_id', auth()->user()->id);
                });
            });
        }elseif(auth()->user()->current_role=='Client'){

        }else{
            $query->whereHas('event', function($qry){
                $qry->where('created_by', auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id);
            });
        }
        $query->latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): EventDocument|null
    {
        $query = EventDocument::with([
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
        ]);
        if(auth()->user()->current_role=='Writer'){
            $query->whereHas('event', function($qr){
                $qr->whereHas('writers', function($qry){
                    $qry->where('writer_id', auth()->user()->id);
                });
            });
        }elseif(auth()->user()->current_role=='Client'){

        }else{
            $query->whereHas('event', function($qry){
                $qry->where('created_by', auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id);
            });
        }
        $data = $query->findOrFail($id);
        return $data;
    }

    public function create(DocumentCreateRequest $request): void
    {
        if($request->file('documents')){
            foreach ($request->file('documents') as $documentfile) {
                if($documentfile->isValid()){
                    $file = $documentfile->hashName();
                    $documentfile->storeAs((new EventDocument)->document_path,$file);
                    EventDocument::create([
                        'document' => $file,
                        'event_id' => $request->event,
                        'created_by' => auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id,
                    ]);
                }
            }
        }
    }

    public function delete(EventDocument $eventDocument): bool|null
    {
        if($eventDocument->document){
            $path = str_replace("storage","app/public",$eventDocument->document);
            (new FileService)->delete_file($path);
        }
        return $eventDocument->delete();
    }

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('name', 'LIKE', '%' . $value . '%');
    }
}
