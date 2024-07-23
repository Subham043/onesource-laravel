<?php

namespace App\Modules\Event\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Requests\EventTogglePrepRequest;
use App\Modules\Event\Services\EventService;

class EventTogglePrepController extends Controller
{
    private $eventService;

    public function __construct(EventService $eventService)
    {
        $this->middleware('permission:edit events', ['only' => ['get','post']]);
        $this->eventService = $eventService;
    }

    public function post(EventTogglePrepRequest $request){
        try {
            //code...
            $this->eventService->togglePrep(
                $request
            );
            return response()->json(["message" => "Event updated successfully."], 200);
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json(["message" => "Something went wrong. Please try again."], 400);
        }

    }
}