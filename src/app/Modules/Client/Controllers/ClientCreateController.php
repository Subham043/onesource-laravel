<?php

namespace App\Modules\Client\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Client\Requests\ClientRequest;
use App\Modules\Client\Services\ClientService;
use App\Modules\Document\Models\DocumentNotification;

class ClientCreateController extends Controller
{
    private $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->middleware('permission:edit clients', ['only' => ['get', 'post']]);
        $this->clientService = $clientService;
    }

    public function get(){
        return view('clients.add')->with([
            'page_name' => 'Client',
            'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get()
        ]);
    }

    public function post(ClientRequest $request){
        try {
            //code...
            $client = $this->clientService->create(
                $request->except('documents'),
            );
            $this->clientService->saveDocument($request, $client->id);
            return response()->json(["message" => "Client created successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again."], 400);
        }
    }
}
