<?php

namespace App\Modules\Event\Services;

use App\Http\Services\FileService;
use App\Modules\Event\Models\Event;
use App\Modules\Event\Models\EventDocument;
use App\Modules\Event\Models\EventWriter;
use App\Modules\Event\Requests\EventCreateRequest;
use App\Modules\Event\Requests\EventUpdateRequest;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class EventService
{

    public function all(): Collection
    {
        return Event::filterByRoles()->latest()->get();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = Event::filterByRoles()->latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): Event|null
    {
        return Event::filterByRoles()->findOrFail($id);
    }

    public function getByWriterId(Int $id): EventWriter|null
    {
        return EventWriter::with([
            'event'=> function($qry){
                $qry->where('created_by', auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id);
            },
        ])->whereHas('event', function($qry){
            $qry->where('created_by', auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id);
        })->findOrFail($id);
    }

    public function create(EventCreateRequest $request): Event
    {
        $event = Event::create(
            [
                ...$request->safe()->only([
                    'name',
                    'invoice_rate',
                    'start_date',
                    'end_date',
                    'start_time',
                    'end_time',
                    'is_recurring_event',
                    'recurring_type',
                    'recurring_days',
                    'recurring_end_date',
                    'notes',
                ]),
                'client_id' => $request->client,
                'created_by' => auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id,
            ]
        );
        foreach ($request->writer_ids as $key=>$value) {
            $event->writers()->save(new EventWriter([
                'writer_id' => $value,
                'billing_rate' => $request->billing_rates[$key],
            ]));
        }
        $this->saveDocument($request, $event->id);
        return $event;
    }

    public function update(EventUpdateRequest $request, Event $event): Event
    {
        $event->update(
            [
                ...$request->safe()->only([
                    'name',
                    'invoice_rate',
                    'start_date',
                    'end_date',
                    'start_time',
                    'end_time',
                    'is_recurring_event',
                    'recurring_type',
                    'recurring_days',
                    'recurring_end_date',
                    'notes',
                ]),
                'client_id' => $request->client,
            ]
        );
        $event->writers()->delete();
        foreach ($request->writer_ids as $key=>$value) {
            $event->writers()->save(new EventWriter([
                'writer_id' => $value,
                'billing_rate' => $request->billing_rates[$key],
            ]));
        }
        $this->saveDocument($request, $event->id);
        return $event;
    }

    public function delete(Event $event): bool|null
    {
        return $event->delete();
    }

    public function deleteWriter(EventWriter $eventWriter): bool|null
    {
        return $eventWriter->delete();
    }

    public function saveDocument(EventCreateRequest|EventUpdateRequest $request, Int $event_id)
    {
        if($request->file('documents')){
            foreach ($request->file('documents') as $documentfile) {
                if($documentfile->isValid()){
                    $file = $documentfile->hashName();
                    $documentfile->storeAs((new EventDocument)->document_path,$file);
                    EventDocument::create([
                        'document' => $file,
                        'event_id' => $event_id,
                        'created_by' => auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id,
                    ]);
                }
            }
        }
    }

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('name', 'LIKE', '%' . $value . '%');
    }
}
