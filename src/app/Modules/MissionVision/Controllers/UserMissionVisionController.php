<?php

namespace App\Modules\MissionVision\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\MissionVision\Resources\UserMissionVisionCollection;
use App\Modules\MissionVision\Services\MissionVisionService;

class UserMissionVisionController extends Controller
{
    private $missionVisionService;

    public function __construct(MissionVisionService $missionVisionService)
    {
        $this->missionVisionService = $missionVisionService;
    }

    public function get(){
        $mission = $this->missionVisionService->getById(1);
        return response()->json([
            'message' => "Mission & Vision recieved successfully.",
            'mission' => UserMissionVisionCollection::make($mission),
        ], 200);
    }
}
