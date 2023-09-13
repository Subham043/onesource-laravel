<?php

namespace App\Modules\AdmissionForm\Services;

use App\Modules\AdmissionForm\Models\AdmissionForm;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class AdmissionFormService
{

    public function all(): Collection
    {
        return AdmissionForm::all();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = AdmissionForm::latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): AdmissionForm|null
    {
        return AdmissionForm::findOrFail($id);
    }

    public function create(array $data): AdmissionForm
    {
        return AdmissionForm::create($data);
    }

    public function update(array $data, AdmissionForm $admission): AdmissionForm
    {
        $admission->update($data);
        return $admission;
    }

    public function delete(AdmissionForm $admission): bool|null
    {
        return $admission->delete();
    }

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('name', 'LIKE', '%' . $value . '%')
        ->orWhere('phone', 'LIKE', '%' . $value . '%')
        ->orWhere('request_type', 'LIKE', '%' . $value . '%')
        ->orWhere('branch', 'LIKE', '%' . $value . '%')
        ->orWhere('course', 'LIKE', '%' . $value . '%')
        ->orWhere('location', 'LIKE', '%' . $value . '%')
        ->orWhere('detail', 'LIKE', '%' . $value . '%')
        ->orWhere('email', 'LIKE', '%' . $value . '%');
    }
}
