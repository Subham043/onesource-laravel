<?php

namespace App\Modules\Event\Event\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Event\Requests\EventCreateRequest;
use App\Modules\Event\Event\Services\EventService;
use App\Modules\Event\Speaker\Services\SpeakerService;

class EventCreateController extends Controller
{
    private $eventService;
    private $speakerService;

    public function __construct(EventService $eventService, SpeakerService $speakerService)
    {
        $this->middleware('permission:create events', ['only' => ['get','post']]);
        $this->eventService = $eventService;
        $this->speakerService = $speakerService;
    }

    public function get(){
        $speaker = $this->speakerService->all();
        return view('admin.pages.event.event.create', compact(['speaker']));
    }

    public function post(EventCreateRequest $request){

        try {
            //code...
            $event = $this->eventService->create(
                $request->except(['image'])
            );
            if($request->hasFile('image')){
                $this->eventService->saveImage($event);
            }
            if($request->speaker && count($request->speaker)>0){
                $this->eventService->save_speakers($event, $request->speaker);
            }else{
                $this->eventService->save_speakers($event, []);
            }
            return response()->json(["message" => "Event created successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
