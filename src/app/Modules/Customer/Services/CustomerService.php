<?php

namespace App\Modules\Customer\Services;

use App\Modules\Customer\Models\Customer;
use App\Modules\Customer\Requests\CustomerUpdatePostRequest;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class CustomerService
{

    public function all(): Collection
    {
        return Customer::all();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = Customer::filterByAdminRole()->filterByCurrentPayment()->withProfile()->latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): Customer|null
    {
        return Customer::filterByAdminRole()->filterByCurrentPayment()->withProfile()->findOrFail($id);
    }

    public function update(CustomerUpdatePostRequest $request, Customer $customer): Customer
    {
        $email = $customer->email;
        $customer->update($request->safe()->only([
            'name',
            'email',
            'phone',
            'timezone',
        ]));
        $customer->profile()->update(
            $request->safe()->only([
                'company',
                'address',
                'city',
                'state',
                'zip',
                'website',
            ])
        );
        if ($request->email != $email) {
            $customer->email_verified_at = null;
            $customer->save();
            $customer->sendEmailVerificationNotification();
        }
        return $customer;
    }

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('name', 'LIKE', '%' . $value . '%')
        ->orWhere('email', 'LIKE', '%' . $value . '%');
    }
}
