<?php

namespace App\Modules\Client\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Client\Requests\ClientRequest;
use App\Modules\Client\Services\ClientService;

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
            'page_name' => 'Client'
        ]);
    }

    public function post(ClientRequest $request){
        try {
            //code...
            $this->clientService->create(
                $request->validated(),
            );
            return redirect()->intended(route('client.paginate.get'))->with('success_status', 'Client created successfully.');
        } catch (\Throwable $th) {
            return redirect()->intended(route('client.create.get'))->with('error_status', 'Something went wrong. Please try again');
        }
    }
}
