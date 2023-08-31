<?php

namespace App\Modules\ExpertTip\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\ExpertTip\Services\ExpertTipService;
use Illuminate\Http\Request;

class ExpertTipPaginateController extends Controller
{
    private $expertTipService;

    public function __construct(ExpertTipService $expertTipService)
    {
        $this->middleware('permission:list expert tips', ['only' => ['get']]);
        $this->expertTipService = $expertTipService;
    }

    public function get(Request $request){
        $data = $this->expertTipService->paginate($request->total ?? 10);
        return view('admin.pages.expertTip.paginate', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
