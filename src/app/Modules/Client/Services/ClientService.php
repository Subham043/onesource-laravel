<?php

namespace App\Modules\Client\Services;

use App\Modules\Client\Models\Client;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Sorts\Sort;

class ClientService
{

    public function all(): Collection
    {
        return Client::where('created_by', auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id)->orderBy('name', 'asc')->get();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = Client::where('created_by', auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id);
        return QueryBuilder::for($query)
                ->defaultSort('name')
                ->allowedSorts([
                    AllowedSort::custom('id', new StringLengthSort(), 'id'),
                    AllowedSort::custom('name', new StringLengthSort(), 'name'),
                ])
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): Client|null
    {
        return Client::where('created_by', auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id)->findOrFail($id);
    }

    public function create(array $data): Client
    {
        $client = Client::create($data);
        $client->created_by = auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id;
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
        $query->where(function($qr) use($value){
            $qr->where('name', 'LIKE', '%' . $value . '%')
            ->orWhere('email', 'LIKE', '%' . $value . '%')
            ->orWhere('phone', 'LIKE', '%' . $value . '%')
            ->orWhere('audio_phone', 'LIKE', '%' . $value . '%')
            ->orWhere('encoder_phone', 'LIKE', '%' . $value . '%')
            ->orWhere('mic_phone', 'LIKE', '%' . $value . '%')
            ->orWhere('invoice_rate', 'LIKE', '%' . $value . '%')
            ->orWhere('address', 'LIKE', '%' . $value . '%')
            ->orWhere('line_placements', 'LIKE', '%' . $value . '%')
            ->orWhere('word', 'LIKE', '%' . $value . '%')
            ->orWhere('notes', 'LIKE', '%' . $value . '%');
        })->where('name', 'LIKE', '%' . $value . '%');
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
