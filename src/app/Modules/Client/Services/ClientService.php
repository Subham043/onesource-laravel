<?php

namespace App\Modules\Client\Services;

use App\Modules\Client\Models\Client;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class ClientService
{

    public function all(): Collection
    {
        return Client::where('created_by', auth()->user()->id)->get();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = Client::where('created_by', auth()->user()->id)->latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): Client|null
    {
        return Client::where('created_by', auth()->user()->id)->findOrFail($id);
    }

    public function create(array $data): Client
    {
        $client = Client::create($data);
        $client->created_by = auth()->user()->id;
        $client->save();
        return $client;
    }

    public function update(array $data, Client $client): Client
    {
        $client->update($data);
        return $client;
    }

    public function delete(Client $client): bool|null
    {
        return $client->delete();
    }

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('name', 'LIKE', '%' . $value . '%');
    }
}
