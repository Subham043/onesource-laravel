<?php

namespace App\Modules\Notification\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Client\Services\ClientService;
use App\Modules\Document\Models\DocumentNotification;
use App\Modules\User\Services\UserService;

class NotificationSendController extends Controller
{
    private $userService;
    private $clientService;

    public function __construct(UserService $userService, ClientService $clientService)
    {
        $this->middleware('permission:add events', ['only' => ['get','post']]);
        $this->userService = $userService;
        $this->clientService = $clientService;
    }

    public function get(){
        $clients = $this->clientService->all();
        $writers = $this->userService->allByWriterRole();
        return view('notifications.send', compact(['clients', 'writers']))->with([
            'page_name' => 'Send Notification',
            'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get()
        ]);
    }

    // public function post(EventCreateRequest $request){

    //     try {
    //         //code...
    //         $this->eventService->create(
    //             $request
    //         );
    //         return response()->json(["message" => "Event created successfully."], 201);
    //     } catch (\Throwable $th) {
    //         // throw $th;
    //         return response()->json(["message" => "Something went wrong. Please try again."], 400);
    //     }

    // }
}
