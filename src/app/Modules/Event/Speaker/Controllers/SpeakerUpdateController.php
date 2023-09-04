<?php

namespace App\Modules\Event\Speaker\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Speaker\Requests\SpeakerUpdateRequest;
use App\Modules\Event\Speaker\Services\SpeakerService;

class SpeakerUpdateController extends Controller
{
    private $speakerService;

    public function __construct(SpeakerService $speakerService)
    {
        $this->middleware('permission:edit events', ['only' => ['get','post']]);
        $this->speakerService = $speakerService;
    }

    public function get($id){
        $data = $this->speakerService->getById($id);
        return view('admin.pages.event.speaker.update', compact(['data']));
    }

    public function post(SpeakerUpdateRequest $request, $id){
        $speaker = $this->speakerService->getById($id);
        try {
            //code...
            $this->speakerService->update(
                $request->except('image'),
                $speaker
            );
            if($request->hasFile('image')){
                $this->speakerService->saveImage($speaker);
            }
            return response()->json(["message" => "Speaker updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
