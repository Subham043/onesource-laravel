<?php

namespace App\Modules\Event\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Client\Services\ClientService;
use App\Modules\Document\Models\DocumentNotification;
use App\Modules\Event\Requests\EventCreateRequest;
use App\Modules\Event\Services\EventService;
use App\Modules\User\Services\UserService;

class EventCreateController extends Controller
{
    private $userService;
    private $eventService;
    private $clientService;

    public function __construct(UserService $userService, EventService $eventService, ClientService $clientService)
    {
        $this->middleware('permission:add events', ['only' => ['get','post']]);
        $this->userService = $userService;
        $this->eventService = $eventService;
        $this->clientService = $clientService;
    }

    public function get(){
        $clients = $this->clientService->all();
        $writers = $this->userService->allByWriterRole();
        return view('events.add', compact(['clients', 'writers']))->with([
            'page_name' => 'Event',
            'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get()
        ]);
    }

    public function post(EventCreateRequest $request){

        try {
            //code...
            $this->eventService->create(
                $request
            );
            return response()->json(["message" => "Event created successfully."], 201);
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json(["message" => "Something went wrong. Please try again."], 400);
        }

    }
}
