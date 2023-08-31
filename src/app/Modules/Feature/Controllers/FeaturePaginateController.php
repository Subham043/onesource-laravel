<?php

namespace App\Modules\Feature\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Feature\Services\FeatureService;
use Illuminate\Http\Request;

class FeaturePaginateController extends Controller
{
    private $featureService;

    public function __construct(FeatureService $featureService)
    {
        $this->middleware('permission:list features', ['only' => ['get']]);
        $this->featureService = $featureService;
    }

    public function get(Request $request, $page){
        $data = $this->featureService->paginate($request->total ?? 10, $page);
        return view('admin.pages.feature.paginate', compact(['data', 'page']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
