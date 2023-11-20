<?php

namespace App\Modules\Event\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Client\Services\ClientService;
use App\Modules\Document\Models\DocumentNotification;
use App\Modules\Event\Requests\EventUpdateRequest;
use App\Modules\Event\Services\EventService;
use App\Modules\User\Services\UserService;

class EventUpdateController extends Controller
{
    private $eventService;
    private $clientService;
    private $userService;

    public function __construct(EventService $eventService, ClientService $clientService, UserService $userService)
    {
        $this->middleware('permission:edit events', ['only' => ['get','post']]);
        $this->eventService = $eventService;
        $this->clientService = $clientService;
        $this->userService = $userService;
    }

    public function get($id){
        $event = $this->eventService->getById($id);
        $clients = $this->clientService->all();
        $writers = $this->userService->allByWriterRole();
        return view('events.edit', compact(['event', 'clients', 'writers']))->with([
            'page_name' => 'Event',
            'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get()
        ]);
    }

    public function post(EventUpdateRequest $request, $id){

        $event = $this->eventService->getById($id);

        try {
            //code...
            $this->eventService->update(
                $request, $event
            );
            return response()->json(["message" => "Event updated successfully."], 200);
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json(["message" => "Something went wrong. Please try again."], 400);
        }

    }
}
