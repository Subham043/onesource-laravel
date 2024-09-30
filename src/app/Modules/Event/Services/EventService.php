<?php

namespace App\Modules\Event\Services;

use App\Modules\Authentication\Models\User;
use App\Modules\Event\Jobs\EventSingleNotificationJob;
use App\Modules\Event\Models\Event;
use App\Modules\Event\Models\EventDocument;
use App\Modules\Event\Models\EventWriter;
use App\Modules\Event\Requests\EventCreateRequest;
use App\Modules\Event\Requests\EventCancelUpdateRequest;
use App\Modules\Event\Requests\EventTogglePrepRequest;
use App\Modules\Event\Requests\EventUpdateRequest;
use App\Modules\User\Services\UserService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Sorts\Sort;

class EventService
{

    public function all($get_current_month=false): Collection
    {
        $query = Event::filterByRoles()->latest();
        if($get_current_month){
            $query->whereBetween('start_date',
            [
                now()->startOfMonth(),
                now()->endOfMonth()
            ]);
        }
        $data = $query->get();
        return $data;
    }

    public function paginate(Int $total = 10, bool $get_current=false): LengthAwarePaginator
    {
        $query = Event::filterByRoles();
        if($get_current){
            $query->whereDate('start_date', today());
        }
        return QueryBuilder::for($query)
                ->defaultSort('-start_date', '-start_time')
                ->allowedSorts([
                    'start_date',
                    'start_time',
                    AllowedSort::custom('id', new StringLengthSort(), 'id'),
                    AllowedSort::custom('name', new StringLengthSort(), 'name'),
                ])
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                    AllowedFilter::callback('status', function (Builder $qr, $value) {
                        if($value == 'upcoming'){
                            $qr->where(function($q){
                                $q->where(function($q){
                                    $q->where('start_date', '<=', today())->where('end_date', '>=', today());
                                })->orWhere(function($q){
                                    $q->where('start_date', '<=', today())->where('recurring_end_date', '>=', today());
                                });
                            });

                        }
                        if($value == 'archived'){
                            $qr->where(function($q){
                                $q->where(function($q){
                                    $q->where('end_date', '<', today());
                                })->orWhere(function($q){
                                    $q->where('recurring_end_date', '<', today());
                                });
                            });

                        }
                    }),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function printAll(): Collection
    {
        $query = Event::filterByRoles();

        return QueryBuilder::for($query)
                ->defaultSort('start_date', 'start_time')
                ->allowedSorts([
                    'start_date',
                    'start_time',
                    AllowedSort::custom('id', new StringLengthSort(), 'id'),
                    AllowedSort::custom('name', new StringLengthSort(), 'name'),
                ])
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->get();
    }

    public function excelReport(): Collection
    {
        $query = Event::filterByRoles();
        $query->latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                    AllowedFilter::callback('has_writer', function (Builder $qr, $value) {
                        $qr->whereHas('writers', function($qry) use($value){
                            $qry->where('writer_id', $value);
                        });
                    }),
                    AllowedFilter::callback('has_client', function (Builder $qr, $value) {
                        $qr->whereHas('client', function($qry) use($value){
                            $qry->where('id', $value);
                        });
                    }),
                    AllowedFilter::callback('has_start_date', function (Builder $qr, $value) {
                        $qr->whereDate('start_date', '>=', $value);
                    }),
                    AllowedFilter::callback('has_end_date', function (Builder $qr, $value) {
                        $qr->whereDate('end_date', '<=', $value);
                    }),
                ])
                ->get();
    }

    public function paginateReport(Int $total = 10): LengthAwarePaginator
    {
        $query = Event::filterByRoles();
        $query->latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                    AllowedFilter::callback('has_writer', function (Builder $qr, $value) {
                        $qr->whereHas('writers', function($qry) use($value){
                            $qry->where('writer_id', $value);
                        });
                    }),
                    AllowedFilter::callback('has_client', function (Builder $qr, $value) {
                        $qr->whereHas('client', function($qry) use($value){
                            $qry->where('id', $value);
                        });
                    }),
                    AllowedFilter::callback('has_start_date', function (Builder $qr, $value) {
                        $qr->whereDate('start_date', '>=', $value);
                    }),
                    AllowedFilter::callback('has_end_date', function (Builder $qr, $value) {
                        $qr->whereDate('end_date', '<=', $value);
                    }),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function paginateQuickbookReport(Int $total = 10):Collection
    {
        $query = Event::filterByRoles();
        $query->latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                    AllowedFilter::callback('has_writer', function (Builder $qr, $value) {
                        $qr->whereHas('writers', function($qry) use($value){
                            $qry->where('writer_id', $value);
                        });
                    }),
                    AllowedFilter::callback('has_client', function (Builder $qr, $value) {
                        $qr->whereHas('client', function($qry) use($value){
                            $qry->where('id', $value);
                        });
                    }),
                    AllowedFilter::callback('has_start_date', function (Builder $qr, $value) {
                        $qr->whereDate('start_date', '>=', $value);
                    }),
                    AllowedFilter::callback('has_end_date', function (Builder $qr, $value) {
                        $qr->whereDate('end_date', '<=', $value);
                    }),
                ])
                ->get();
    }

    public function allConflict(): Collection
    {
        return User::with([
            'writerEvents' => function($qry){
                $qry->with(['event']);
            }
        ])
        ->whereHas('writerEvents', function($qry){
            $qry->whereHas('event', function($qr){
                $start_date = Carbon::now()->startOfMonth();
                $date = $start_date;
                $end_date = Carbon::now()->lastOfMonth();
                while($start_date>=$date && $end_date<=$date){
                    $qr->whereDate('end_date', '>=', $date->format('Y-m-d'))->whereDate('start_date', '<=', $date->format('Y-m-d'));
                    $date->addDays(1);
                }
            });
        })
        ->whereIn('id', (new UserService)->allByWriterRole()->pluck('id'))
        ->get();
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
        if(auth()->user()->timezone){
            $tz = auth()->user()->timezone->getTimezoneName();
            $start_time = Carbon::createFromFormat('H:i', $request->start_time, $tz)->setTimezone('UTC')->format('Y-m-d H:i:s');
        }else{
            $start_time = $request->start_time;
        }
        if(auth()->user()->timezone){
            $tz = auth()->user()->timezone->getTimezoneName();
            $end_time = Carbon::createFromFormat('H:i', $request->end_time, $tz)->setTimezone('UTC')->format('Y-m-d H:i:s');
        }else{
            $end_time = $request->end_time;
        }
        $event = Event::create(
            [
                ...$request->safe()->only([
                    'name',
                    'invoice_rate',
                    'start_date',
                    'end_date',
                    // 'start_time',
                    // 'end_time',
                    'is_recurring_event',
                    'recurring_end_date',
                    'recurring_type',
                    'recurring_daily_type',
                    'recurring_daily_days',
                    'recurring_weekly_weeks',
                    'recurring_weekly_sunday',
                    'recurring_weekly_monday',
                    'recurring_weekly_tuesday',
                    'recurring_weekly_wednesday',
                    'recurring_weekly_thursday',
                    'recurring_weekly_friday',
                    'recurring_weekly_saturday',
                    'recurring_monthly_type',
                    'recurring_monthly_first_days',
                    'recurring_monthly_first_months',
                    'recurring_monthly_second_type',
                    'recurring_monthly_second_days',
                    'recurring_monthly_second_months',
                    'recurring_yearly_months',
                    'recurring_yearly_days',
                    'notes',
                    'rate_type',
                    'fuzion_id',
                    'is_prep_ready',
                    'is_active',
                ]),
                'client_id' => $request->client,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'created_by' => auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id,
            ]
        );
        if($request->writer_ids && $request->billing_rates){
            foreach ($request->writer_ids as $key=>$value) {
                if(!empty($value) && !empty($request->billing_rates[$key])){
                    $event->writers()->save(new EventWriter([
                        'writer_id' => $value,
                        'billing_rate' => $request->billing_rates[$key],
                    ]));
                }
            }
        }
        $this->saveDocument($request, $event->id);
        $this->sendNotification($event->id, 'created');
        return $event;
    }

    public function prepUpdate(EventCancelUpdateRequest $request): void
    {
        Event::filterByRoles()->whereIn('id', $request->event)->update(['is_active' => false]);
    }

    public function togglePrep(EventTogglePrepRequest $request): void
    {
        foreach ($request->event as $value) {
            $event = $this->getById($value);
            $event->is_prep_ready = !$event->is_prep_ready;
            $event->save();
        }
    }

    public function update(EventUpdateRequest $request, Event $event): Event
    {
        if(auth()->user()->timezone){
            $tz = auth()->user()->timezone->getTimezoneName();
            $start_time = Carbon::createFromFormat('H:i', $request->start_time, $tz)->setTimezone('UTC')->format('Y-m-d H:i:s');
        }else{
            $start_time = $request->start_time;
        }
        if(auth()->user()->timezone){
            $tz = auth()->user()->timezone->getTimezoneName();
            $end_time = Carbon::createFromFormat('H:i', $request->end_time, $tz)->setTimezone('UTC')->format('Y-m-d H:i:s');
        }else{
            $end_time = $request->end_time;
        }
        $event->update(
            [
                ...$request->safe()->only([
                    'name',
                    'invoice_rate',
                    'start_date',
                    'end_date',
                    // 'start_time',
                    // 'end_time',
                    'is_recurring_event',
                    'recurring_end_date',
                    'recurring_type',
                    'recurring_daily_type',
                    'recurring_daily_days',
                    'recurring_weekly_weeks',
                    'recurring_weekly_sunday',
                    'recurring_weekly_monday',
                    'recurring_weekly_tuesday',
                    'recurring_weekly_wednesday',
                    'recurring_weekly_thursday',
                    'recurring_weekly_friday',
                    'recurring_weekly_saturday',
                    'recurring_monthly_type',
                    'recurring_monthly_first_days',
                    'recurring_monthly_first_months',
                    'recurring_monthly_second_type',
                    'recurring_monthly_second_days',
                    'recurring_monthly_second_months',
                    'recurring_yearly_months',
                    'recurring_yearly_days',
                    'notes',
                    'rate_type',
                    'fuzion_id',
                    'is_prep_ready',
                    'is_active',
                ]),
                'start_time' => $start_time,
                'end_time' => $end_time,
                'client_id' => $request->client,
            ]
        );
        if($request->writer_ids && $request->billing_rates){
            $event->writers()->delete();
            foreach ($request->writer_ids as $key=>$value) {
                if(!empty($value) && !empty($request->billing_rates[$key])){
                    $event->writers()->save(new EventWriter([
                        'writer_id' => $value,
                        'billing_rate' => $request->billing_rates[$key],
                    ]));
                }
            }
        }
        $this->saveDocument($request, $event->id);
        $this->sendNotification($event->id, 'updated');
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
                    $file = str()->snake($request->name).'_EVD'.$event_id.'_'.$documentfile->hashName();
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

    public function sendNotification(int $event_id, string $type): void
    {
        $event = Event::filterByRoles()->find($event_id);
        // dispatch(new EventSingleNotificationJob($event->creator, $event, $type));
        foreach ($event->writers as $key => $value) {
            # code...
            dispatch(new EventSingleNotificationJob($value->writer, $event, $type));
        }
    }

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('name', 'LIKE', '%' . $value . '%')
        ->orWhereHas('writers', function($qry) use($value){
            $qry->whereHas('writer', function($qry) use($value){
                $qry->where('name', 'LIKE', '%' . $value . '%');
            });
        })
        ->orWhereHas('client', function($qry) use($value){
            $qry->where('name', 'LIKE', '%' . $value . '%');
        });
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
