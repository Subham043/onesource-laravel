<?php

namespace App\Modules\Notification\Services;

use App\Modules\Notification\Models\Notification;
use App\Modules\Notification\Requests\NotificationRequest;
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

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('label', 'LIKE', '%' . $value . '%');
    }
}
