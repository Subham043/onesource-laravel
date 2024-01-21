<?php

namespace App\Modules\Search\Services;

use App\Modules\Authentication\Models\User;
use App\Modules\Event\Models\Event;
use App\Modules\Event\Models\EventDocument;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Sorts\Sort;

class SearchService
{

    public function event_paginate(Int $total = 10, bool $get_current=false): LengthAwarePaginator
    {
        $query = Event::filterByRoles();
        if($get_current){
            $query->whereDate('start_date', today());
        }
        $data = QueryBuilder::for($query)
                ->defaultSort('name')
                ->allowedSorts([
                    AllowedSort::custom('id', new StringLengthSort(), 'id'),
                    AllowedSort::custom('name', new StringLengthSort(), 'name'),
                ])
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonEventFilter),
                ])
                ->paginate($total,['*'],'event_page')
                ->withQueryString();
        return $data;
    }

    public function document_paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = EventDocument::filterByRoles();
        $data = QueryBuilder::for($query)
                ->defaultSort('document')
                ->allowedSorts([
                    AllowedSort::custom('id', new StringLengthSort(), 'id'),
                    AllowedSort::custom('document', new StringLengthSort(), 'document'),
                ])
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonDocumentFilter),
                ])
                ->paginate($total,['*'],'document_page')
                ->withQueryString();
        return $data;
    }

    public function user_paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = User::filterMemberCreatedByAuth();
        $data = QueryBuilder::for($query)
                ->defaultSort('name')
                ->allowedSorts([
                    AllowedSort::custom('id', new StringLengthSort(), 'id'),
                    AllowedSort::custom('name', new StringLengthSort(), 'name'),
                ])
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonUserFilter),
                ])
                ->paginate($total,['*'],'user_page')
                ->withQueryString();
        return $data;
    }


}

class CommonEventFilter implements Filter
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

class CommonDocumentFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('document', 'LIKE', '%' . $value . '%')
        ->orWhereHas('event', function($qryy) use($value){
            $qryy->where('name', 'LIKE', '%' . $value . '%')
            ->orWhereHas('writers', function($qry) use($value){
                $qry->whereHas('writer', function($qry) use($value){
                    $qry->where('name', 'LIKE', '%' . $value . '%');
                });
            })
            ->orWhereHas('client', function($qry) use($value){
                $qry->where('name', 'LIKE', '%' . $value . '%');
            });
        });
    }
}


class CommonUserFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('name', 'LIKE', '%' . $value . '%')
        ->orWhere('email', 'LIKE', '%' . $value . '%');
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
