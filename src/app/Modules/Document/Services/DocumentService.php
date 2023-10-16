<?php

namespace App\Modules\Document\Services;

use App\Http\Services\FileService;
use App\Modules\Event\Models\Event;
use App\Modules\Event\Models\EventDocument;
use App\Modules\Document\Requests\DocumentCreateRequest;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class DocumentService
{

    public function all(): Collection
    {
        return EventDocument::filterByRoles()->latest()->get();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = EventDocument::filterByRoles()->latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): EventDocument|null
    {
        return EventDocument::filterByRoles()->findOrFail($id);
    }

    public function create(DocumentCreateRequest $request): void
    {
        if($request->file('documents')){
            foreach ($request->file('documents') as $documentfile) {
                if($documentfile->isValid()){
                    $file = $documentfile->hashName();
                    $documentfile->storeAs((new EventDocument)->document_path,$file);
                    EventDocument::create([
                        'document' => $file,
                        'event_id' => $request->event,
                        'created_by' => auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id,
                    ]);
                }
            }
        }
    }

    public function delete(EventDocument $eventDocument): bool|null
    {
        if($eventDocument->document){
            $path = str_replace("storage","app/public",$eventDocument->document);
            (new FileService)->delete_file($path);
        }
        return $eventDocument->delete();
    }

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('name', 'LIKE', '%' . $value . '%');
    }
}
