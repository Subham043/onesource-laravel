<?php

namespace App\Modules\Client\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Client\Services\ClientService;

class ClientDeleteController extends Controller
{
    private $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->middleware('permission:delete clients', ['only' => ['get']]);
        $this->clientService = $clientService;
    }

    public function get($id){
        $client = $this->clientService->getById($id);

        try {
            //code...
            $this->clientService->delete(
                $client
            );
            return redirect()->back()->with('success_status', 'Client deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
