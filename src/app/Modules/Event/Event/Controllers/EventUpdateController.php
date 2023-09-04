<?php

namespace App\Modules\Event\Event\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Event\Requests\EventUpdateRequest;
use App\Modules\Event\Event\Services\EventService;
use App\Modules\Event\Speaker\Services\SpeakerService;

class EventUpdateController extends Controller
{
    private $eventService;
    private $speakerService;

    public function __construct(EventService $eventService, SpeakerService $speakerService)
    {
        $this->middleware('permission:edit events', ['only' => ['get','post']]);
        $this->eventService = $eventService;
        $this->speakerService = $speakerService;
    }

    public function get($id){
        $data = $this->eventService->getById($id);
        $speaker = $this->speakerService->all();
        $speakers =$data->speakers->pluck('id')->toArray();
        return view('admin.pages.event.event.update', compact(['data', 'speaker', 'speakers']));
    }

    public function post(EventUpdateRequest $request, $id){
        $event = $this->eventService->getById($id);
        try {
            //code...
            $this->eventService->update(
                $request->except(['image']),
                $event
            );
            if($request->hasFile('image')){
                $this->eventService->saveImage($event);
            }
            if($request->speaker && count($request->speaker)>0){
                $this->eventService->save_speakers($event, $request->speaker);
            }
            return response()->json(["message" => "Event updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
