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

class SearchService
{

    public function event_paginate(Int $total = 10, bool $get_current=false): LengthAwarePaginator
    {
        $query = Event::filterByRoles();
        if($get_current){
            $query->whereDate('start_date', today());
        }
        $query->latest();
        $data = QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonEventFilter),
                ])
                ->paginate($total,['*'],'event_page')
                ->withQueryString();
        return $data;
    }

    public function document_paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = EventDocument::filterByRoles()->latest();
        $data = QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonDocumentFilter),
                ])
                ->paginate($total,['*'],'document_page')
                ->withQueryString();
        return $data;
    }

    public function user_paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = User::filterMemberCreatedByAuth()->latest();
        $data = QueryBuilder::for($query)
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
            $qryy->whereHas('writers', function($qry) use($value){
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
