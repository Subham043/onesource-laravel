<?php

namespace App\Modules\Client\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Client\Services\ClientService;
use App\Modules\Document\Models\DocumentNotification;

class ClientViewController extends Controller
{
    private $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->middleware('permission:view clients', ['only' => ['get']]);
        $this->clientService = $clientService;
    }
    public function get($id){
        $data = $this->clientService->getById($id);
        return view('clients.view', compact('data'))->with([
            'page_name' => 'Client',
            'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get()
        ]);
    }
}
