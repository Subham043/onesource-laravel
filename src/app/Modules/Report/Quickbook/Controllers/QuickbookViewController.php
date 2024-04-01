<?php

namespace App\Modules\Report\Quickbook\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Client\Services\ClientService;
use App\Modules\Document\Models\DocumentNotification;
use App\Modules\Event\Services\EventService;
use App\Modules\User\Services\UserService;
use App\Modules\Report\Export\Exports\QuickbookExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
        $data = $this->eventService->paginateQuickbookReport($request->total ?? 10);
        $clients = $this->clientService->all();
        $writers = $this->userService->allByWriterRole();
        // return $data;
        return view('reports.quickbook', compact(['data', 'clients', 'writers']))->with([
            'page_name' => 'Quickbook',
            'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get()
        ])
        ->with('search', $request->query('filter')['search'] ?? '');
    }

    public function excel(Request $request){
        $data = $this->eventService->paginateQuickbookReport($request->total ?? 10);
        return Excel::download(new QuickbookExport($data), 'quickbook.csv', \Maatwebsite\Excel\Excel::CSV, [
                'Content-Type' => 'text/csv',
        ]);
    }
}