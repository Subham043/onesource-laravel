<?php

namespace App\Modules\Tool\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Document\Models\DocumentNotification;
use App\Modules\Tool\Services\ToolService;

class ToolViewController extends Controller
{
    private $toolService;

    public function __construct(ToolService $toolService)
    {
        $this->middleware('permission:view tools', ['only' => ['get']]);
        $this->toolService = $toolService;
    }
    public function get($id){
        $data = $this->toolService->getById($id);
        return view('tools.view', compact('data'))->with([
            'page_name' => 'Tool',
            'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get()
        ]);
    }
}
