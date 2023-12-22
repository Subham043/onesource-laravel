<?php

namespace App\Modules\Notification\Services;

use App\Modules\Authentication\Models\User;
use App\Modules\Event\Models\Event;
use App\Modules\Notification\Jobs\ClientNotificationJob;
use App\Modules\Notification\Jobs\WriterNotificationJob;
use App\Modules\Notification\Models\Notification;
use App\Modules\Notification\Requests\NotificationRequest;
use App\Modules\User\Services\UserService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class NotificationService
{

    public function all($get_current_month=false): Collection
    {
        $query = Notification::filterByRoles()->latest();
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
        $query = Notification::filterByRoles();
        if($get_current){
            $query->whereDate('start_date', today());
        }
        $query->latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): Notification|null
    {
        return Notification::filterByRoles()->findOrFail($id);
    }

    public function create(NotificationRequest $request): Notification
    {
        $event = Notification::create(
            [
                ...$request->safe()->only([
                    'label',
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
                ]),
                'created_by' => auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id,
            ]
        );
        return $event;
    }

    public function update(NotificationRequest $request, Notification $event): Notification
    {
        $event->update(
            [
                ...$request->safe()->only([
                    'label',
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
                ]),
            ]
        );
        return $event;
    }

    public function delete(Notification $event): bool|null
    {
        return $event->delete();
    }

    public function sendWriterNotification(Int $id)
    {
        $data = User::with([
            'writerEvents' => function($qry){
                $qry->with(['event'])->whereHas('event', function($qr){
                    $date =  Carbon::today();
                    $qr->where('is_active', true)
                    ->whereDate('end_date', '>=', $date->format('Y-m-d'))
                    ->whereDate('start_date', '<=', $date->format('Y-m-d'))
                    ->where('created_by', auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id);
                });
            }
        ])
        ->whereHas('writerEvents', function($qry){
            $qry->whereHas('event', function($qr){
                $date =  Carbon::today();
                $qr->where('is_active', true)
                ->whereDate('end_date', '>=', $date->format('Y-m-d'))
                ->whereDate('start_date', '<=', $date->format('Y-m-d'))
                ->where('created_by', auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id);
            });
        })
        ->where('id', $id)
        ->first();

        if($data){
            $new_data = $data->writerEvents->filter(function($item) {
                if(!$item->event->is_recurring_event){
                    return true;
                }
                return (in_array(Carbon::today()->format('Y-m-d')."T05:30:00.000Z", $item->event->event_repeated_date));
             });
             dispatch(new WriterNotificationJob($data, $new_data, (new TemplateService)->get()));
             return count($new_data->toArray());
        }

        return null;

    }

    public function sendClientNotification(Int $id)
    {
        $date =  Carbon::today();
        $data = Event::with([
            'client' => function($qr) use($id){
                $qr->where('id', $id);
            }
        ])->where('is_active', true)
        ->whereDate('end_date', '>=', $date->format('Y-m-d'))
        ->whereDate('start_date', '<=', $date->format('Y-m-d'))
        ->where('created_by', auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id)
        ->whereHas('client', function($qry) use($id){
            $qry->where('id', $id);
        })->get();

        if($data && count($data)>0){
            $all_clients = (new UserService)->allByClientRole();
            $clients = $all_clients->filter(function($item) use($id) {
                return $item->member_profile_created_by_auth->client->id==$id;
            });
            $new_data = $data->filter(function($item) {
                if(!$item->is_recurring_event){
                    return true;
                }
                return (in_array(Carbon::today()->format('Y-m-d')."T05:30:00.000Z", $item->event_repeated_date));
            });
            dispatch(new ClientNotificationJob($clients, $new_data, (new TemplateService)->get()));
            return count($new_data->toArray());
            return $new_data;
        }

        return null;
    }

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('label', 'LIKE', '%' . $value . '%');
    }
}
