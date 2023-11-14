<?php

namespace App\Modules\Tool\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Document\Models\DocumentNotification;
use App\Modules\Tool\Services\ToolService;
use Illuminate\Http\Request;

class ToolPaginateController extends Controller
{
    private $toolService;

    public function __construct(ToolService $toolService)
    {
        $this->middleware('permission:list tools', ['only' => ['get']]);
        $this->toolService = $toolService;
    }
    public function get(Request $request){
        $data = $this->toolService->paginate($request->total ?? 10);
        return view('tools.list', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '')->with([
                'page_name' => 'Tool',
                'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get()
            ]);
    }

}
