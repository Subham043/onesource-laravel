<?php

namespace App\Modules\Report\Quickbook\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Client\Services\ClientService;
use App\Modules\Event\Services\EventService;
use App\Modules\User\Services\UserService;
use Illuminate\Http\Request;

class QuickbookViewController extends Controller
{
    private $eventService;
    private $userService;
    private $clientService;

    public function __construct(EventService $eventService, UserService $userService, ClientService $clientService)
    {
        $this->middleware('permission:view quickbook', ['only' => ['get','post']]);
        $this->eventService = $eventService;
        $this->userService = $userService;
        $this->clientService = $clientService;
    }

    public function get(Request $request){
        $data = $this->eventService->paginateReport($request->total ?? 10);
        $clients = $this->clientService->all();
        $writers = $this->userService->allByWriterRole();
        return view('reports.quickbook', compact(['data', 'clients', 'writers']))->with([
            'page_name' => 'Quickbook'
        ])
        ->with('search', $request->query('filter')['search'] ?? '');
    }
}
