<?php

namespace App\Modules\Client\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Client\Services\ClientService;

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
            'page_name' => 'Client'
        ]);
    }
}
