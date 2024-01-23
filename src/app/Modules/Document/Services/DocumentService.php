<?php

namespace App\Modules\Document\Services;

use App\Http\Services\FileService;
use App\Modules\Event\Models\Event;
use App\Modules\Event\Models\EventDocument;
use App\Modules\Document\Requests\DocumentCreateRequest;
use App\Modules\Document\Requests\DocumentDeleteRequest;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Sorts\Sort;

class DocumentService
{

    public function all(): Collection
    {
        return EventDocument::filterByRoles()->latest()->get();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = EventDocument::filterByRoles()
        ->selectRaw('event_documents.*, events.*, event_writers.*')
        ->join('events', 'events.id', '=', 'event_documents.event_id')
        ->join('event_writers', 'event_writers.event_id', '=', 'events.id')
        ->join('users', 'event_writers.writer_id', '=', 'users.id');
        return QueryBuilder::for($query)
                ->defaultSort('document')
                ->allowedSorts([
                    AllowedSort::custom('document', new StringLengthSort(), 'document'),
                    AllowedSort::callback('writer', function (Builder $query, bool $descending, string $property) {
                        $direction = $descending ? 'DESC' : 'ASC';
                        $query->orderBy('users.name', $direction);
                    }),
                    AllowedSort::callback('client', function (Builder $query, bool $descending, string $property) {
                        $direction = $descending ? 'DESC' : 'ASC';
                        $query->orderBy('events.client_id', $direction);
                    }),
                    AllowedSort::callback('id', function (Builder $query, bool $descending, string $property) {
                        $direction = $descending ? 'DESC' : 'ASC';
                        $query->orderBy('events.id', $direction);
                    }),
                    AllowedSort::callback('start_time', function (Builder $query, bool $descending, string $property) {
                        $direction = $descending ? 'DESC' : 'ASC';
                        $query->orderBy('events.start_time', $direction);
                    }),
                    AllowedSort::callback('start_date', function (Builder $query, bool $descending, string $property) {
                        $direction = $descending ? 'DESC' : 'ASC';
                        $query->orderBy('events.start_date', $direction);
                    }),
                ])
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): EventDocument|null
    {
        return EventDocument::filterByRoles()->findOrFail($id);
    }

    public function create(DocumentCreateRequest $request): void
    {
        if($request->file('documents')){
            foreach ($request->file('documents') as $documentfile) {
                if($documentfile->isValid()){
                    $event = Event::findOrFail($request->event);
                    $file = str()->snake($event->name).'_EVD'.$event->id.'_'.$documentfile->hashName();
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

    public function docDelete(DocumentDeleteRequest $request): void
    {
        EventDocument::filterByRoles()->whereIn('id', $request->document)->delete();
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

class StringLengthSort implements Sort
{
    public function __invoke(Builder $query, bool $descending, string $property)
    {
        $direction = $descending ? 'DESC' : 'ASC';

        $query->orderByRaw("LENGTH(`{$property}`) {$direction}")->orderBy($property, $direction);
    }
}
