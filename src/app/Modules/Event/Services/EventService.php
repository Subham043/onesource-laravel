<?php

namespace App\Modules\Event\Services;

use App\Modules\Event\Models\Event;
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
        return Event::where('created_by', auth()->user()->id)->get();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = Event::where('created_by', auth()->user()->id)->latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): Event|null
    {
        return Event::where('created_by', auth()->user()->id)->findOrFail($id);
    }

    public function create(array $data): Event
    {
        $tool = Event::create($data);
        $tool->created_by = auth()->user()->id;
        $tool->save();
        return $tool;
    }

    public function update(array $data, Event $tool): Event
    {
        $tool->update($data);
        return $tool;
    }

    public function delete(Event $tool): bool|null
    {
        return $tool->delete();
    }

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('name', 'LIKE', '%' . $value . '%');
    }
}
