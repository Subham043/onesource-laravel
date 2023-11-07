<?php

namespace App\Modules\Client\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Client\Requests\ClientRequest;
use App\Modules\Client\Services\ClientService;

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
            'page_name' => 'Client'
        ]);
    }

    public function post(ClientRequest $request, $id){
        $client = $this->clientService->getById($id);

        try {
            //code...
            $this->clientService->update(
                $request->validated(),
                $client
            );
            return redirect()->intended(route('client.paginate.get'))->with('success_status', 'Client updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->intended(route('client.update.get', $client->id))->with('error_status', 'Something went wrong. Please try again');
        }
    }
}
