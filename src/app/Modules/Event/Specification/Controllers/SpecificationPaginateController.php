<?php

namespace App\Modules\Event\Specification\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Specification\Services\SpecificationService;
use Illuminate\Http\Request;

class SpecificationPaginateController extends Controller
{
    private $specificationService;

    public function __construct(SpecificationService $specificationService)
    {
        $this->middleware('permission:list events', ['only' => ['get']]);
        $this->specificationService = $specificationService;
    }

    public function get(Request $request, $event_id){
        $data = $this->specificationService->paginate($request->total ?? 10, $event_id);
        return view('admin.pages.event.specification.paginate', compact(['data', 'event_id']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
