<?php

namespace App\Modules\Event\Speaker\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Speaker\Requests\SpeakerCreateRequest;
use App\Modules\Event\Speaker\Services\SpeakerService;

class SpeakerCreateController extends Controller
{
    private $speakerService;

    public function __construct(SpeakerService $speakerService)
    {
        $this->middleware('permission:create events', ['only' => ['get','post']]);
        $this->speakerService = $speakerService;
    }

    public function get(){
        return view('admin.pages.event.speaker.create');
    }

    public function post(SpeakerCreateRequest $request){

        try {
            //code...
            $speaker = $this->speakerService->create(
                $request->except('image')
            );
            if($request->hasFile('image')){
                $this->speakerService->saveImage($speaker);
            }
            return response()->json(["message" => "Speaker created successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
