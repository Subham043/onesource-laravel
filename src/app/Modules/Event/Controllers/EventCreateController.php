<?php

namespace App\Modules\Event\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Requests\EventCreateRequest;
use App\Modules\Event\Services\EventService;
use App\Modules\User\Services\UserService;

class EventCreateController extends Controller
{
    private $userService;
    private $eventService;

    public function __construct(UserService $userService, EventService $eventService)
    {
        $this->middleware('permission:add events', ['only' => ['get','post']]);
        $this->userService = $userService;
        $this->eventService = $eventService;
    }

    public function get(){
        $clients = $this->userService->allByClientRole();
        $writers = $this->userService->allByWriterRole();
        return view('events.add', compact(['clients', 'writers']))->with([
            'page_name' => 'Event',
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
            return response()->json(["message" => "Something went wrong. Please try again."], 400);
        }

    }
}
