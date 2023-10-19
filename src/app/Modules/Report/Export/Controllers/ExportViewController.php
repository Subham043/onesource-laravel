<?php

namespace App\Modules\Report\Export\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Services\EventService;
use App\Modules\User\Services\UserService;
use Illuminate\Http\Request;

class ExportViewController extends Controller
{
    private $eventService;
    private $userService;

    public function __construct(EventService $eventService, UserService $userService)
    {
        $this->middleware('permission:view exports', ['only' => ['get','post']]);
        $this->eventService = $eventService;
        $this->userService = $userService;
    }
    public function get(Request $request){
        $data = $this->eventService->paginateReport($request->total ?? 10);
        $writers = $this->userService->allByWriterRole();
        return view('reports.export', compact(['data', 'writers']))->with([
            'page_name' => 'Export'
        ])
        ->with('search', $request->query('filter')['search'] ?? '');
    }
}
