<?php

namespace App\Modules\Client\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Client\Services\ClientService;
use App\Modules\Document\Models\DocumentNotification;
use Illuminate\Http\Request;

class ClientPaginateController extends Controller
{
    private $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->middleware('permission:list clients', ['only' => ['get']]);
        $this->clientService = $clientService;
    }
    public function get(Request $request){
        $data = $this->clientService->paginate($request->total ?? 10);
        return view('clients.list', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '')->with([
                'page_name' => 'Client',
                'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get()
            ]);
    }

}
