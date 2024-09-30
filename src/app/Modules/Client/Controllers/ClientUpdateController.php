<?php

namespace App\Modules\Client\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Client\Requests\ClientRequest;
use App\Modules\Client\Services\ClientService;
use App\Modules\Document\Models\DocumentNotification;

class ClientUpdateController extends Controller
{
    private $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->middleware('permission:edit clients', ['only' => ['get', 'post']]);
        $this->clientService = $clientService;
    }

    public function get($id){
        $data = $this->clientService->getById($id);
        return view('clients.edit', compact(['data']))->with([
            'page_name' => 'Client',
            'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get()
        ]);
    }

    public function post(ClientRequest $request, $id){
        $client = $this->clientService->getById($id);

        try {
            //code...
            $this->clientService->update(
                $request->except('documents'),
                $client
            );
            $this->clientService->saveDocument($request, $client->id);
            return response()->json(["message" => "Client updated successfully."], 200);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again."], 400);
        }
    }
}
