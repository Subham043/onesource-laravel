<?php

namespace App\Modules\Notification\Services;

use App\Modules\Notification\Models\NotificationLog;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\QueryBuilder;

class NotificationLogService
{
    public function paginate(Int $total = 10, bool $get_current=false): LengthAwarePaginator
    {
        $query = NotificationLog::filterByRoles();
        $query->latest();
        return QueryBuilder::for($query)
                ->paginate($total)
                ->appends(request()->query());
    }
}
