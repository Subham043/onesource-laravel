<?php

namespace App\Modules\Event\Speaker\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Speaker\Resources\UserSpeakerCollection;
use App\Modules\Event\Speaker\Services\SpeakerService;

class UserSpeakerAllController extends Controller
{
    private $speakerService;

    public function __construct(SpeakerService $speakerService)
    {
        $this->speakerService = $speakerService;
    }

    public function get(){
        $speaker = $this->speakerService->main_all();
        return response()->json([
            'message' => "Speaker recieved successfully.",
            'speaker' => UserSpeakerCollection::collection($speaker),
        ], 200);
    }

}
