<?php

namespace App\Modules\MissionVision\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\MissionVision\Requests\MissionVisionRequest;
use App\Modules\MissionVision\Services\MissionVisionService;

class MissionVisionController extends Controller
{
    private $missionVisionService;

    public function __construct(MissionVisionService $missionVisionService)
    {
        $this->middleware('permission:edit mission vision', ['only' => ['get','post']]);
        $this->missionVisionService = $missionVisionService;
    }

    public function get(){
        $data = $this->missionVisionService->getById(1);
        return view('admin.pages.mission.index', compact(['data']));
    }

    public function post(MissionVisionRequest $request){
        try {
            //code...
            $missionVision = $this->missionVisionService->createOrUpdate(
                $request->except('image'),
            );
            return response()->json(["message" => "Mission & Vision updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
